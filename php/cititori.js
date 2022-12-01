let id = $("input[name*='id_cititor']");
id.attr("readonly", false);

$(".btnedit").click((e) => {
  let textvalues = displayData(e);
  let nume_cititor = $("input[name*='nume_cititor']");
  let prenume_cititor = $("input[name*='prenume_cititor']");
  let nrtel = $("input[name*='nr_telefon']");
  let email = $("input[name*='email']");
  id.val(textvalues[0]);
  nume_cititor.val(textvalues[1]);
  prenume_cititor.val(textvalues[2]);
  nrtel.val(textvalues[3]);
  email.val(textvalues[4]);
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
