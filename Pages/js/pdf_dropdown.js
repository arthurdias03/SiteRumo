$(document).ready(function(){
  $(".pdfDropdown").each(function() {
    var dropdown = $(this);
    var folder = dropdown.data("folder");

    $.ajax({
      url: folder,
      success: function (data) {
        var pdfFiles = [];
        $(data).find("a[href$='.pdf']").each(function () {
          var pdfFileName = $(this).attr("href").split('/').pop(); // Extrai o nome do arquivo
          pdfFiles.push({ name: pdfFileName, path: $(this).attr("href") });
        });
        pdfFiles.sort(function(a, b) {
          return a.name.localeCompare(b.name); // Ordena os arquivos pelo nome
        });
        pdfFiles.forEach(function(pdfFile) {
          dropdown.append('<option value="' + pdfFile.path + '">' + pdfFile.name + ' </option>');
        });
      }
    });
  });

  // Download do PDF selecionado
  $(".pdfDropdown").change(function() {
    var selectedPdf = $(this).val();
    if (selectedPdf) {
      // Cria um link temporário para o download do PDF
      var link = document.createElement('a');
      link.href = selectedPdf;
      link.download = selectedPdf.split('/').pop(); // Nome do arquivo para download
      link.click();
    }
  });
});

