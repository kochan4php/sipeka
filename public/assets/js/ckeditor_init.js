const CKEDITOR_INIT = (id) => {
  const variable = document.getElementById(id);
  CKEDITOR.replace(variable, {
    language: "en-gb",
  });
  CKEDITOR.config.allowedContent = true;
};
