$(() => {
    handlers()
})

var articleToAdd = {}
var saleArticles = []

handlers = () => {
    document.querySelector('#frmAddArticle').addEventListener('submit', function (evt) {
        evt.preventDefault()
    })
    document.querySelector('#addQuantity').addEventListener('click', function(evt) {
        evt.preventDefault()
        changeQuantity('add')
    })
    document.querySelector('#subQuantity').addEventListener('click', function(evt) {
        evt.preventDefault()
        changeQuantity('sub')
    })
    document.querySelector('#noArticle').addEventListener('keyup', function (evt) {
        evt.preventDefault()
        var article = this.value
        var url = `${siteURL}/sale/findArticle`
        $.getJSON(url, {noArticle: article}, function(result) {
            var box = document.getElementById('possibleArticles')
            box.innerHTML = '';
            if (result.length) {
                result.forEach(element => {
                    var option = document.createElement('a')
                    option.className = 'list-group-item list-group-item-action select-article'
                    option.innerText = `${element.sku} - ${element.name}`
                    option.dataset.id = element.id
                    option.dataset.name = element.name
                    option.dataset.sku = element.sku
                    option.dataset.price = element.price
                    box.append(option)
                });
            } else {
                box.innerHTML = '<a class="list-group-item list-group-item-action">No hay opciones</a>'
            }
        });
    })
    // document.querySelector('#noArticle').addEventListener('blur', function (evt) {
    //     document.getElementById('possibleArticles').innerHTML = '';
    // })
    document.querySelector('#possibleArticles').addEventListener('click', function(evt) {
        var classes = evt.target.classList
        var data = evt.target.dataset
        for (var i = 0; i < classes.length; i++) {
            if (classes[i] == 'select-article') {
                articleToAdd.id = data.id
                articleToAdd.sku = data.sku
                articleToAdd.price = data.price
                articleToAdd.name = data.name
                document.querySelector('#divSelectArticle').style.display = 'none'
                document.querySelector('#selectedArticleText').style.display = 'flex'
                document.querySelector('#selectedArticleLabel').innerText = data.name
                document.querySelector('#quantity').value = 1
                document.querySelector('#btnAddArticle').removeAttribute('disabled')
                document.querySelector('#possibleArticles').innerHTML = '';
                document.querySelector('#noArticle').value = '';
                break;
            }
        }
    })
    document.querySelector('#cancelArticle').addEventListener('click', function(evt) {
        evt.preventDefault()
        refreshArticleToAdd()
    })
    document.querySelector('#btnAddArticle').addEventListener('click', function(evt) {
        evt.preventDefault()
        articleToAdd.quantity = parseInt(document.querySelector('#quantity').value)
        addArticle()
        refreshArticleToAdd()
    })

    function changeQuantity(actionType = 'none') {
        var inpQuantity = document.querySelector('#quantity')
        var quantity = parseInt(inpQuantity.value)
        if (actionType === 'add') {
            inpQuantity.value = ++quantity
        } else if (actionType === 'sub') {
            quantity = quantity == 1 ? 1 : --quantity
            inpQuantity.value = quantity
        }
    }

    function addArticle() {
        var exists = false
        saleArticles.forEach((article) => {
            if (articleToAdd.id == article.id) {
                article.quantity = parseInt(article.quantity) + parseInt(articleToAdd.quantity)
                exists = true
                return false
            }
        })
        if (!exists) {
            saleArticles.push(articleToAdd)
        }
        refreshArticlesTable()
    }

    function refreshArticleToAdd() {
        document.querySelector('#divSelectArticle').style.display = 'flex'
        document.querySelector('#selectedArticleText').style.display = 'none'
        document.querySelector('#selectedArticleLabel').innerText = ''
        document.querySelector('#quantity').value = 0
        document.querySelector('#btnAddArticle').setAttribute('disabled', true)
        articleToAdd = {}
    }

    function refreshArticlesTable() {
        rows = ''
        saleArticles.forEach((article) => {
            var totalPrice = article.quantity * article.price
            var row = `<tr>
                <td class="text-center">${article.sku}</td>
                <td class="text-left">${article.name}</td>
                <td class="text-center">${article.quantity}</td>
                <td class="text-right">${article.price}</td>
                <td class="text-right">${totalPrice.toFixed(2)}</td>
                <td class="text-center">
                  <i class="fa fa-times text-danger remove-article" 
                    title="Quitar articulo" data-id="${article.id}"></i>
                </td>
            </tr>`
            rows += row
        })
        document.querySelector('#articlesList').innerHTML = rows
    }
}

