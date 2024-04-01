var easyMDE = new EasyMDE({
      minHeight: "20rem",
      spellChecker: false,
      inputStyle: "contenteditable",
      nativeSpellcheck: true,
      previewImagesInEditor: true,
      promptURLs: true,
      sideBySideFullscreen: false,
      toolbar: [
          "heading", "|",
          "bold", "italic", "strikethrough", "|",
          "unordered-list", "ordered-list", "table", "|",
          "link", "image", "|",
          "side-by-side", "fullscreen", "preview", "|",
          "guide"
      ]
  });

easyMDE.toggleSideBySide();
