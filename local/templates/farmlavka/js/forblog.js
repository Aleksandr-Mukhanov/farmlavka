document.addEventListener('DOMContentLoaded', function () {
//Blog start
    //const sectionsWrap = document.querySelector('.health-blog__categories');//обновление контента в разделе блог по тегам и категориям
    const tagsWrap = document.querySelector('.tags');

    if (tagsWrap) {
    // const sections = sectionsWrap.querySelectorAll('.health-blog__item');
    const allTags = tagsWrap.querySelectorAll('.tag');
    const dataContainer = document.querySelector('.js-data');

        // sections.forEach(item => {

        //     item.addEventListener('click', (a) => {
        //         a.preventDefault();
        //         item.classList.add('active');
        //         dataContainer.setAttribute("data-section", item.dataset.section);
        //         dataReload();
        //     })
        // })

        allTags.forEach(item => {
            item.addEventListener('click', (a) => {
                a.preventDefault();
                item.classList.add('active');
                dataContainer.setAttribute("data-tag", item.dataset.tag);
                dataReload();
            })
        })

        function dataReload() {
            const formData = new FormData();

            formData.append('section', dataContainer.dataset.section);
            formData.append('tag', dataContainer.dataset.tag);

            fetch('/local/ajax/blogFilter.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                document.querySelector('.js-data').innerHTML = data;
            })
        }
    }

    let openModal = document.querySelector('.modal-open');//для модалки с видео и успешного отзыва
    let closeBtn = document.querySelector('.modal-close');
    let modal = document.querySelector('.callme-form-modal');

    if (openModal) {
      openModal.addEventListener('click', function () {
          modal.style.display = 'block';
      })
    }

    if (closeBtn) {
      closeBtn.onclick = function () {
          modal.style.display = 'none';
      }
    }
    window.onclick = function (e) {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    }


    let stars = document.querySelectorAll('.js-label1');//звезды отзывов под статьей
    if (stars) {
        stars.forEach(star => {
            star.addEventListener('click', function () {
                clickedStar = star;
                stars.forEach(star => {
                    star.classList.remove('_selected-star');
                    star.style.pointerEvents = 'none';
                })
                clickedStar.classList.add('_selected-star');
                for (let i = 0; i < clickedStar.dataset.count; i++) {
                    stars[i].classList.add('_selected-star');
                }
            })
        });
    }

    let submitStar = document.querySelector('.js-review-submit');
    if (submitStar) {
        submitStar.addEventListener('click', function () {
            submitStar.style.display = 'none';
        })
    }

    let addStars = document.querySelectorAll('.js-label');//звезды отзывов при добавлении отзыва
    addStars.forEach(star => {
        star.addEventListener('click', function () {
            clickedStar = star;
            addStars.forEach(item => {
                item.classList.remove('_selected-star');
                item.style.pointerEvents = 'none';
            })
            clickedStar.classList.add('_selected-star');
            for (let i = 0; i < clickedStar.dataset.count; i++) {
                addStars[i].classList.add('_selected-star');
            }
        })
    });


    const form = document.querySelector('#modalReadLater');//форма "Прочитать позже"
    if (form) {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            let error = formValidate(form);
                messContain = form.querySelector('.js-mess-container');
                inputsContain = form.querySelector('.js-inputs-container');

                formData = new FormData();
                inputName = document.querySelector('.js-name').value;
                inputMail = document.querySelector('.js-email').value;
                articleName = document.querySelector('.articles__a-main-content').dataset.name;
                articleUrl = document.location.host + document.querySelector('.articles__a-main-content').dataset.url;

            formData.append('name', inputName);
            formData.append('email', inputMail);
            formData.append('articlename', articleName);
            formData.append('articleurl', articleUrl);

            if (error === 0) {
                let response = await fetch('/local/ajax/sendFormBlog.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    let result = await response.json();
                    inputsContain.style.display = 'none';
                    messContain.style.color = 'green';
                    messContain.innerHTML = result.message;
                    form.reset();
                } else {
                    messContain.innerHTML = 'Произошла ошибка, повторите вашу заявку.';
                }
            } else {
                messContain.innerHTML = 'Заполните все поля';
            }

            function formValidate(form) {
                let error = 0;
                let inputRequired = document.querySelectorAll('.js-required');
                for (let index = 0; index < inputRequired.length; index++) {
                    const input = inputRequired[index];

                    if (input.classList.contains('_error')) {
                        removeErreor(input);
                    }
                    if (input.value === '') {
                        addError(input);
                        error++;
                    }

                }

                return error;
            }

            function addError(inputRequired) {
                inputRequired.classList.add('_error');
            }
            function removeErreor(inputRequired) {
                inputRequired.classList.remove('_error');
            }
        });

    }



//Blog end
})
