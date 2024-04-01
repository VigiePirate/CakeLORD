var easyMDE = new EasyMDE({
    element: document.getElementById('about_me'),
    minHeight: "20rem",
    spellChecker: false,
    inputStyle: "contenteditable",
    nativeSpellcheck: true,
    previewImagesInEditor: true,
    promptURLs: true,
    sideBySideFullscreen: false,
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "unordered-list", "ordered-list", "table", "|",
        "link", "|",
        "side-by-side", "fullscreen", "preview", "|",
        "guide"
    ]
});
var easyMDE2 = new EasyMDE({
    element: document.getElementById('staff_comments'),
    minHeight: "20rem",
    spellChecker: false,
    inputStyle: "contenteditable",
    nativeSpellcheck: true,
    previewImagesInEditor: true,
    promptURLs: true,
    sideBySideFullscreen: false,
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "unordered-list", "ordered-list", "table", "|",
        "link", "|",
        "side-by-side", "fullscreen", "preview", "|",
        "guide"
    ]
});
easyMDE.toggleSideBySide();
easyMDE2.toggleSideBySide();
