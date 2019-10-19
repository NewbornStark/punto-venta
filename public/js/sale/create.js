$(() => {
    handlers()
})

var articleToAdd = {}
var saleArticles = []
const i18n = new Intl.NumberFormat('es-MX', {style: 'currency', currency: 'MXN'})

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
                    option.dataset.description = element.description
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
        var data = evt.target.dataset
        if (evt.target.classList.contains('select-article')) {
            articleToAdd.id = data.id
            articleToAdd.sku = data.sku
            articleToAdd.price = data.price
            articleToAdd.name = data.name
            articleToAdd.description = data.description
            document.querySelector('#divSelectArticle').style.display = 'none'
            document.querySelector('#selectedArticleText').style.display = 'flex'
            document.querySelector('#selectedArticleLabel').innerText = data.name
            document.querySelector('#quantity').value = 1
            document.querySelector('#btnAddArticle').removeAttribute('disabled')
            document.querySelector('#possibleArticles').innerHTML = '';
            document.querySelector('#noArticle').value = '';
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
    document.querySelector('#articlesList').addEventListener('click', function(evt) {
        var element = evt.target
        var id = element.dataset.id
        if (element.classList.contains('remove-article')) {
            var sure = confirm('¿Está seguro de quitar el artículo?')
            if (!sure) return false
            saleArticles = saleArticles.filter((article) => article.id != id)
            refreshArticlesTable()
            if (!saleArticles.length) {
                document.querySelector('#btnSave').setAttribute('disabled', true)
            }
        }
    })
    document.querySelector('#discount').addEventListener('change', function(evt) {
        evt.preventDefault()
        refreshArticlesTable()
    })
    document.querySelector('#btnSave').addEventListener('click', function(evt) {
        evt.preventDefault()
        var slcPayment = document.querySelector('#payment')
        var data = {
            payment: slcPayment.item(slcPayment.selectedIndex).text,
            discount: document.querySelector('#discount').value,
            articles: saleArticles
        }
        var params = {
            method: 'POST',
            credentials: 'same-origin',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('#csrf').value
            }
        }
        fetch(`${siteURL}/sales`, params)
            .then((res) => {
                return res.json()
            })
            .then((data) => {
                if (data.hasOwnProperty('errors')) {
                    alert(data.errors.join('\n'))
                } else if (data.hasOwnProperty('success') && data.success) {
                    var urlTicket = `${siteURL}/sale/ticket/${data.sale}`
                    window.open(urlTicket, '_blank', 'width=350,height=400')
                    window.setTimeout(() => {
                        window.location = `${siteURL}/sales`
                    }, 2000)
                }
            })
            .catch()
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
        if (saleArticles.length) {
            document.querySelector('#btnSave').removeAttribute('disabled')
        }
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
        var rows = ''
        var subtotal = 0
        var discount = parseFloat(document.querySelector('#discount').value)
        saleArticles.forEach((article) => {
            var totalPrice = article.quantity * article.price
            subtotal = subtotal + totalPrice
            var row = `<tr>
                <td class="text-center">${article.sku}</td>
                <td class="text-left">${article.name}</td>
                <td class="text-center">${article.quantity}</td>
                <td class="text-right">${i18n.format(article.price)}</td>
                <td class="text-right">${i18n.format(totalPrice)}</td>
                <td class="text-center">
                  <i class="fa fa-times text-danger remove-article" 
                    title="Quitar articulo" data-id="${article.id}"></i>
                </td>
            </tr>`
            rows += row
        })
        subtotal = subtotal.toFixed(2)
        document.querySelector('#articlesList').innerHTML = rows
        document.querySelector('#subtotal').innerHTML = i18n.format(subtotal)
        document.querySelector('#total').innerHTML = i18n.format(subtotal - discount)
    }
}

