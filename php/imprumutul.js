let id = $("input[name*='data_imprumut']");
id.attr("readonly", false);

$(".btnedit").click((e) => {
  let textvalues = displayData(e);
  let data_returnare = $("input[name*='data_returnare']");
  let data_returnarii = $("input[name*='data_returnarii']");
  let status_cartea_nr_carte = $("input[name*='status_cartea_nr_carte']");
  let cititorul_id_cititor = $("input[name*='cititorul_id_cititor']");
  id.val(textvalues[0]);
  data_returnare.val(textvalues[1]);
  data_returnarii.val(textvalues[2]);
  status_cartea_nr_carte.val(textvalues[3]);
  cititorul_id_cititor.val(textvalues[4]);
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
