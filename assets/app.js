/* Установка темы */
function theme(name, value)
{
    var oldvalue = PF.H.getCookie(name);
    // применить сразу, если:
    switch (name)
    {
        case 'skin':
            document.body.classList.remove("skin-" + oldvalue);
            document.body.classList.add("skin-" + value);
            break;
        case 'sidebar':
            value = document.body.classList.toggle("sidebar-collapse");
            document.body.classList.toggle("sidebar-collapse");
            break;
    }
    /* Записать в куки */
    PF.H.setCookie(name, value);
}