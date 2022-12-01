let id = $("input[name*='nr_carte']");
id.attr("readonly", false);

$(".btneditSC").click((e) => {
  let textvalues = displayDataSC(e);
  let disponibilitate = $("input[name*='disponibilitate']");
  let cartea_isbn = $("input[name*='cartea_isbn']");
  id.val(textvalues[0]);
  disponibilitate.val(textvalues[1]);
  cartea_isbn.val(textvalues[2]);
});

function displayDataSC(e) {
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
