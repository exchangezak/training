let listeBoutton=document.querySelectorAll(".del")
listeBoutton.forEach(function(element){
    element.addEventListener("click",function(e){
       let button=e.target
       let id=button.getAttribute("data-id")
       console.log(id);
       let input=document.querySelector(".delete input[name=id]")
        input.value=id
        document.querySelector(".delete button[type=submit]").click()
    })
})
