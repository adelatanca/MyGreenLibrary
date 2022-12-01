let id = $("input[name*='id_autor']");
id.attr("readonly", false);

$(".btnedit").click((e) => {
  let textvalues = displayData(e);
  let numeAutor = $("input[name*='nume_autor']");
  let prenumeAutor = $("input[name*='prenume_autor']");
  let gen = $("input[name*='gen']");
  id.val(textvalues[0]);
  numeAutor.val(textvalues[1]);
  prenumeAutor.val(textvalues[2]);
  gen.val(textvalues[3]);
});

function displayData(e) {
  let id = 0;
  const td = $("#tbody tr td");
  let textvalues = [];

  for (const value of td) {
    if (value.dataset.id == e.target.dataset.id) {
      textvalues[id++] = value.textContent;
    }
  }
  return textvalues;
}
