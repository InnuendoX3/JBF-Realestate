document.addEventListener('DOMContentLoaded', () => {
    let categorySelector = document.querySelector('#jbf-category-parents');
    let form = document.querySelector('#jbf-search');
    let tags = Array.from(document.querySelectorAll('.jbf-checkbox'));
    //let checkboxContainer = document.querySelector('#jbf-search-tags');
    let categoryChildren;
    
    if(categorySelector) {
        categoryChildren = Array.from(
            Array(document.querySelector('#jbf-search-category-children').children)[0]
        );

        categorySelector.addEventListener('change', () => {
            let selected = categorySelector.value + '-child';
            categoryChildren.forEach((child) => {
                if(child.id == selected) {
                    child.classList.remove('hidden');
                    child.removeAttribute("disabled");
                } else {
                    child.classList.add('hidden');
                    child.setAttribute("disabled", "disabled");
                }
            })
        })

        /*categoryChildren.forEach(child => {
            child.addEventListener('change', () => {
                if(child.value !== "") {
                    checkboxContainer.classList.remove('collapsed');
                } else {
                    checkboxContainer.classList.add('collapsed');
                }
            })
        })*/
    }

    tags.forEach(container => {
        label = container.querySelector('label');
        label.addEventListener('click', (e) => {
            console.log(e.target);
            input = e.target.parentNode.querySelector('input');
            if(!input.hasAttribute('disabled')) {
                input.setAttribute('disabled', 'disabled');
            } else {
                input.removeAttribute('disabled');
            }

            e.target.classList.toggle('bg-primary');
        })
    })

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        if(categorySelector.value === "") {
            categorySelector.setAttribute('disabled', 'disabled');
        }

        if(categoryChildren.some(child => child.value !== "")) {
            categorySelector.setAttribute('disabled', 'disabled');
        }

        categoryChildren.forEach(child => {
            if(child.value === "") {
                child.setAttribute('disabled', 'disabled');
            }
        })

        setTimeout(() => {
            form.submit();
        }, 0);
    })

})