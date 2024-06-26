<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Chronos\Chronos;
use Cake\Http\Client;
use Cake\I18n\I18n;

/**
 * Coats Controller
 *
 * @property \App\Model\Table\CoatsTable $Coats
 *
 * @method \App\Model\Entity\Coat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoatsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['view', 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $sort_fields = (I18n::getLocale() == I18n::getDefaultLocale())
            ? ['name' => 'name', 'genotype' => 'genotype', 'description' => 'description']
            : ['name' => 'CoatsTranslation.name', 'genotype' => 'CoatsTranslation.genotype', 'description' => 'CoatsTranslation.description'];
        $coats = $this->paginate($this->Coats, ['order' => ['id' => 'asc'], 'sortableFields' => array_values($sort_fields)]);
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');
        $show_staff = !is_null($user) && $user->can('add', $this->Coats);
        $this->set(compact('coats', 'sort_fields', 'user', 'show_staff'));
    }

    /**
     * View method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coat = $this->Coats->get($id);
        $this->Authorization->skipAuthorization();

        // FIXME: move to model
        $examples = $this->Coats->Rats->find()
            ->where([
                ['coat_id' => $id],
                ['picture !=' => 'Unknown.png'],
                ['picture !=' => ''],
                ['picture IS NOT' => null]])
            ->order(['rand()'])
            ->limit(32)
            ->toArray();

        $count = $coat->countMy('Rats', 'coat');
        $frequency = $coat->frequencyOfMy('Rats', 'coat');

        $recent_count = $coat->countMy('rats', 'coat', ['birth_date >=' => Chronos::today()->modify('-2 years')]);
        $recent_frequency = $coat->frequencyOfMy('rats', 'coat', ['birth_date >=' => Chronos::today()->modify('-2 years')]);

        $age['all'] = $count ? $coat->roundLifespan(['coat_id' => $coat->id]) : __('N/A');
        $age['female'] = $count ? $coat->roundLifespan(['coat_id' => $coat->id, 'sex' => 'F']) : __('N/A');
        $age['male'] = $count ? $coat->roundLifespan(['coat_id' => $coat->id, 'sex' => 'M']) : __('N/A');

        $labo = 'http://laborats.weebly.com/' . h(preg_replace('/\s+/', '-', str_replace('é', 'eacute', mb_strtolower($coat->name)))) . '.html';
        $client = new Client();
        $response = $client->get($labo);
        $is_labo = ($response->getStatusCode() != 404);

        $user = $this->request->getAttribute('identity');
        $show_staff = ! is_null($user) && $user->can('add', $this->Coats);

        $this->set(compact('coat', 'examples', 'count', 'frequency', 'recent_count', 'recent_frequency', 'age', 'is_labo', 'labo', 'user', 'show_staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coat = $this->Coats->newEmptyEntity();
        $this->Authorization->authorize($coat);

        if ($this->request->is('post')) {
            $locale = I18n::getLocale();
            $default = I18n::getDefaultLocale();
            I18n::setLocale($default);
            $coat = $this->Coats->patchEntity($coat, $this->request->getData());

            if ($this->Coats->save($coat)) {
                //FIXME Create translation entries. Could be in model or behavior
                $locales = Configure::read('App.supportedLocales');
                $translations = $this->fetchModel('CoatsTranslations');
                foreach ($locales as $loc => $value) {
                    if ($loc != $locale) {
                        $coatTranslation = $translations->newEmptyEntity();
                        $coatTranslation->id = $coat->id;
                        $coatTranslation->locale = $loc;
                        $coatTranslation->name = $coat->name;
                        $coatTranslation->genotype = $coat->genotype;
                        $coatTranslation->description = $coat->description;
                        $translations->save($coatTranslation);
                    }
                }
                I18n::setLocale($locale);
                $this->Flash->warning(__('The new coat has been saved, but only in English. ') . __('Change your preferred language and edit the sheet to add a translation.'));
                return $this->redirect(['action' => 'index']);
            }
            I18n::setLocale($locale);
            $this->Flash->error(__('The coat could not be saved. Please, try again.'));
        }
        $this->set(compact('coat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coat = $this->Coats->get($id);
        $this->Authorization->authorize($coat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coat = $this->Coats->patchEntity($coat, $this->request->getData());
            if ($this->Coats->save($coat)) {
                $this->Flash->success(__('The coat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coat could not be saved. Please, try again.'));
        }
        $user = $this->request->getAttribute('identity');
        $this->set(compact('coat', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coat = $this->Coats->get($id);
        $this->Authorization->authorize($coat);
        if ($this->Coats->delete($coat)) {
            $this->Flash->success(__('The coat has been deleted.'));
        } else {
            $this->Flash->error(__('The coat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
