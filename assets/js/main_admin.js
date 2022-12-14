$(document).ready(function(){
    /** start of sidebar: code for collapsing and expanding sidebar */

    // expanding and collapsing sidebar items
    $(".menu-item.has-sub-menu > a").on("click", function(e){
        e.preventDefault()
        $(e.currentTarget).parent().toggleClass("collapsed")
        $(e.currentTarget).children(".icon-right").toggleClass("expanded")
    })

    // navbar expand and collapse on btn click
    $("#sidebar-btn").on("click", function(e){
        let vertical_menu = $(".vertical-menu")[0]
        let navbar_brand = $(".navbar-brand")[0]
        vertical_menu.classList.toggle("expanded")
        navbar_brand.classList.toggle("expanded")
    })

    // close sidebar when clicked outside them after open
    $(document).click(function(e){
        if(!e.target.closest("#sidebar-btn")){ // due to menu btn and document both event trigerred causing no effects
            if($(".vertical-menu").length > 0){
                if($(".vertical-menu")[0].classList.contains("expanded")){
                    if(e.target.closest('.vertical-menu') === null){
                        $(".vertical-menu")[0].classList.toggle("expanded")
                    }
                }
            }
        }
    })

    /** end of sidebar */

    // data tables
    let dataTable = $("#data-table")
    if(dataTable.length > 0){
        dataTable.DataTable({
            responsive: true
        });
    }

    let toggle_password = $(".toggle-password")
    if(toggle_password.length > 0){
        toggle_password.on("click", function(e){
            e.preventDefault()
            let current_target = $(e.currentTarget)
            current_target.toggleClass("show")

            if(current_target.hasClass("show")){
                current_target.html('<i class="bi bi-eye-slash-fill fs-5"></i>')
                current_target.siblings("input").attr("type", "text")
            }else{
                current_target.html('<i class="bi bi-eye-fill fs-5"></i>')
                current_target.siblings("input").attr("type", "password")

            }
        })
    }
})