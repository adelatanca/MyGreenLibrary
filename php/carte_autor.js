let id = $("input[name*='id']");
id.attr("readonly", false);

$(".btnedit").click((e) => {
  let textvalues = displayData(e);
  let cartea_isbn = $("input[name*='cartea_isbn']");
  let autorul_id_autor = $("input[name*='autorul_id_autor']");

  id.val(textvalues[0]);
  cartea_isbn.val(textvalues[1]);
  autorul_id_autor.val(textvalues[2]);
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
