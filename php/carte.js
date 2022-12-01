let id = $("input[name*='isbn']");
id.attr("readonly", false);

$(".btneditC").click((e) => {
  let textvalues = displayData(e);
  let titlu = $("input[name*='titlu']");
  let editura = $("input[name*='editura']");
  let nrex = $("input[name*='nr_exemplare']");
  let categorie = $("input[name*='categorie']");
  id.val(textvalues[0]);
  titlu.val(textvalues[1]);
  editura.val(textvalues[2]);
  nrex.val(textvalues[3]);
  categorie.val(textvalues[4]);
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
