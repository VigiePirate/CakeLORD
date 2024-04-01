var easyMDE = new EasyMDE({
      minHeight: "20rem",
      spellChecker: false,
      inputStyle: "contenteditable",
      nativeSpellcheck: true,
      previewImagesInEditor: true,
      promptURLs: true,
      sideBySideFullscreen: false,
      toolbar: [
          "bold", "italic", "strikethrough", "|",
          "unordered-list", "ordered-list", "|",
          "link", "|",
          "side-by-side", "fullscreen", "preview", "|",
          "guide"
      ]
  });

easyMDE.toggleSideBySide();
