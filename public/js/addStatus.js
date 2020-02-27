const button = document.getElementById('addStatus');
const formStatus = document.getElementById('formAddStatus');
const formInitial = document.getElementById('formInitial');
const valueButton = button.innerText;

button.addEventListener('click', () => {
    if(button.className === 'Seller'){
        console.log(button.innerText);
        if(button.innerText == 'HIDE THE FORM'){
            formStatus.innerHTML = '<span></span>';
            button.innerText = valueButton;
        }else{
            let name = "<div class='form-group row'>" +
                "<textarea rows='5' class='offset-2 col-sm-8 form-control' cols='33' name='seller_description' placeholder='description of the seller'></textarea>" +
                "</div>" +
                "<div class='form-group row'>" +
                "<input type='text' class='offset-2 col-sm-8 form-control' name='seller_adress' placeholder='the sales address' >" +
                "</div>" +
                "<div class='form-group row'>" +
                "<input type='text' class='offset-2 col-sm-8 form-control' name='seller_city' placeholder='the sales city' >" +
                "</div>" +
                "<div class='form-group row'>" +
                "<input type='number' class='offset-2 col-sm-8 form-control' name='seller_postal_code' placeholder='the sales postal code' >" +
                "</div>" +
                "<div class='form-group row'>" +
                "<button  type='submit' name='button'>Add Status</button>"
                "</div>";
            button.innerText = 'hide the Form';
            formStatus.insertAdjacentHTML('beforeend',name);
        }
    }else if(button.className === 'Tourist'){
        console.log(formInitial);
        formInitial.submit();
    }
});

/*
<input type="hidden" name="default_status" value="{{strtolower($profile)}}">
*/
