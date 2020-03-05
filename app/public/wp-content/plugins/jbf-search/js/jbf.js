document.addEventListener('DOMContentLoaded', () => {
    let categorySelector = document.querySelector('#jbf-category-parents');
    let form = document.querySelector('#jbf-search');
    let checkboxes = Array.from(document.querySelectorAll('.jbf-checkbox'));
    let checkboxContainer = document.querySelector('#jbf-search-tags');
    console.log(checkboxes);
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

    checkboxes.forEach(container => {
        checkbox = container.querySelector('input');
        checkbox.addEventListener('click', () => {
            label = container.querySelector('label');
            label.classList.toggle('bg-primary');
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