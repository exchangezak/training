let butDel = document.querySelectorAll(".del");
let input = document.querySelector(".delete input[name=id]")
butDel.forEach(function (del) {
   del.addEventListener("click", function (e) {
      let direction = e.target
      let ip = direction.getAttribute("id")
      input.value = ip
      document.querySelector(".delete button[type=submit]").click()
   })
})
let butMod = document.querySelectorAll(".modif")
butMod.forEach(function (mod) {
   mod.addEventListener("click", function (e) {
      let direction = e.target
      let ip = direction.getAttribute("id")
      let titre = direction.getAttribute("tit")
      let description = direction.getAttribute("des")
      let statut=direction.getAttribute("stat")
      document.querySelector(".update input[name=id]").value= ip
      document.querySelector(".update input[name=title]").value = titre
      document.querySelector(".update input[name=description]").value = description
      // JE SELECTIONNE EN CSS LA BONNE BALISE radio ET JE LA CHECK EN HTML
      document.querySelector(".update input[value=" + statut + "]").checked = true;

   })
})
