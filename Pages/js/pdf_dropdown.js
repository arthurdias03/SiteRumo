
$(document).ready(function(){
  $(".pdfDropdown").each(function() {
    var dropdown = $(this);
    var folder = dropdown.data("folder");

    $.ajax({
      url: folder,
      success: function (data) {
        var pdfFiles = [];
        $(data).find("a[href$='.pdf']").each(function () {
          pdfFiles.push($(this).attr("href"));
        });
        pdfFiles.sort();
        pdfFiles.forEach(function(pdfFile) {
          dropdown.append('<option value="' + pdfFile + '">' + pdfFile + '</option>');
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