<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Care</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>Exam</h1>
        <div id="category">
        </div>
        <script type="text/javascript">

            const login = () => {

                return new Promise((resolve,reject)=>{
                    $.ajax({
                        type : 'POST',
                        url : '{{ route('homecare.login') }}',
                        data : {
                            email : 'testuser@example.com',
                            password : 'testuser',
                        },
                        dataType : 'json',
                        success : (response)=>{
                            resolve(response.access_token);
                        }
                    });
                });
            }

            const get = (url,bearer) => {

                return new Promise((resolve,reject)=>{
                    $.ajax({
                        type : 'GET',
                        url : url,
                        beforeSend : (xhr) => {
                            xhr.setRequestHeader('Authorization', `Bearer ${bearer}`)
                        },
                        dataType : 'json',
                        success : (response) => {
                            resolve(response);
                        }
                    });
                })

            }
            
            const bind = (token) => {

                $('.btn_brands_clear').on('click',(e)=>{

                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    li = $(e.target).parents()[1];
                    $(li).find('div').empty();

                    a_text = $(li).find('span').find('a');
                    oldtext = a_text.text();
                    oldhref = a_text.attr('href');
                    newtext = oldtext.replace('hide','show');

                    $(li).find('span').empty().append(` - <a href='${oldhref}' class='btn_brands'>${newtext}</a>`);

                    bind(token);
                });

                $('.btn_variants_clear').on('click',(e)=>{
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    li = $(e.target).parents()[1];
                    $(li).find('div').empty();

                    a_text = $(li).find('span').find('a');
                    oldtext = a_text.text();
                    oldhref = a_text.attr('href');
                    newtext = oldtext.replace('hide','show');

                    $(li).find('span').empty().append(` - <a href='${oldhref}' class='btn_variants'>${newtext}</a>`);

                    bind(token);
                });

                $('.btn_variants').on('click',(e)=>{
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    a = $(e.target);
                    li = $(a).parents()[1];

                    console.log(a.attr('href'));
                    console.log(li);

                    a_text = $(li).find('span').find('a');
                    oldtext = a_text.text();
                    oldhref = a_text.attr('href');
                    newtext = oldtext.replace('show','hide');
                    
                    $(li).find('span').empty().append(` - <a href='${oldhref}' class='btn_variants_clear'>${newtext}</a>`);

                    bind(token);

                    div = $(li).find('div');

                    div.empty();
                    div.append("<ul style='list-style-type:none;'></ul>");
                    ul = $(div).find('ul');

                    get(a.attr('href'),token).then(variants => {

                        brandName = $(li).contents().get(1).nodeValue;
                        variants.data.forEach((item,idx) => {
                            ul.append(`<li>${item.name} ${brandName}</li>`);
                        });

                    })

                });

                $('.btn_brands').on('click',(e)=>{

                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    a = $(e.target);
                    li = $(a.parents())[1];
                    console.log(a.attr('href'));
                    console.log(li);

                    a_text = $(li).find('span').find('a');
                    oldtext = a_text.text();
                    oldhref = a_text.attr('href');
                    newtext = oldtext.replace('show','hide');
                    
                    $(li).find('span').empty().append(` - <a href='${oldhref}' class='btn_brands_clear'>${newtext}</a>`);

                    div = $(li).find('div');

                    div.empty();
                    div.append("<ul style='list-style-type:none;'></ul>");
                    ul = $(div).find('ul');

                    get(a.attr('href'),token).then(brands => {

                        cboxParents = $(li).contents().get(0).checked;
                        console.log(cboxParents);

                        brands.data.forEach((item,idx)=>{
                            ul.append(`<li><input id=brand_${item.id} type='checkbox' class='chk_variants'>${item.name}<span></span><div></div></li>`);

                            $(ul).find('li').find('input').prop('checked',cboxParents);

                            bind(token);

                            variantUrl = "{{ route('homecare.variants','brandcode') }}";
                            variantUrl = variantUrl.replace(/brandcode/,item.id);

                            get(variantUrl,token).then(variant => {

                                if(variant.total > 0)
                                {
                                    variantUrl = "{{ route('homecare.variants','brandcode') }}";
                                    variantUrl = variantUrl.replace(/brandcode/,item.id);

                                    idx = idx+1;
                                    li = $(ul).find(`li:nth-child(${idx})`);
                                    li.find('span').append(` - <a href='${variantUrl}' class='btn_variants'>show subitem (${variant.total})</a>`)

                                    if(cboxParents === true)
                                    {
                                        li.find('div').empty().append("<ul style='list-style-type:none;'></ul>");
                                        variant.data.forEach((variant_item,idx)=>{
                                            li.find('div').find('ul').append(`<li>${variant_item.name} ${item.name}</li>`);
                                        });
                                    }

                                    bind(token);

                                }

                            });


                        });
                    });
                })

                $('.chk_category').on('click',(e)=>{
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    checkbox = $(e.target);
                    console.log(checkbox.prop('checked'));

                    if(checkbox.prop('checked') === true)
                    {
                        li = $(e.target).parent();
                        $(li).find('div').empty();
                        console.log(li);

                        a_text = $(li).find('span').find('a');
                        oldtext = a_text.text();
                        oldhref = a_text.attr('href');
                        newtext = oldtext.replace('show','hide');

                        $(li).find('span').find('a').click();
                    }

                    if(checkbox.prop('checked') === false)
                    {
                        li = $(e.target).parent();
                        $(li).find('div').empty();
                        console.log(li);

                        a_text = $(li).find('span').find('a');
                        oldtext = a_text.text();
                        oldhref = a_text.attr('href');
                        newtext = oldtext.replace('hide','show');

                        $(li).find('span').empty().append(` - <a href='${oldhref}' class='btn_brands'>${newtext}</a>`);

                        bind(token);
                    }

                })

            }

            $(document).ready(()=>{

                login().then(result => {

                    get('{{ route('homecare.categories') }}',result).then(category => {
                        if (category.total > 0)
                        {
                            $('#category').append("<ul style='list-style-type:none;'></ul>");
                            ul = $('#category > ul');
                            category.data.forEach((item,idx)=>{

                                brandUrl = "{{ route('homecare.brands','catcode') }}";
                                brandUrl = brandUrl.replace(/catcode/,item.id);

                                ul.append(`<li><input id=cat_${item.id} type='checkbox' class='chk_category'>${item.name}<span></span><div></div></li>`);
                                bind(result);

                                get(brandUrl,result).then(brand => {
                                    if(brand.total > 0)
                                    {
                                        idx = idx+1;
                                        li = $(`#category > ul > li:nth-child(${idx})`);

                                        brandUrl = "{{ route('homecare.brands','catcode') }}";
                                        brandUrl = brandUrl.replace(/catcode/,item.id);
                                        li.find('span').append(` - <a href='${brandUrl}' class='btn_brands'>show subitem (${brand.total})</a>`);
                                        bind(result);
                                    }

                                });

                            });
                            
                        }

                    });

                });
 
            });

        </script>
    </body>
</html>