document.addEventListener('DOMContentLoaded', () => {
    let categorySelector = document.querySelector('#jbf-category-parents');
    let categoryChildren = Array.from(
            Array(document.querySelector('#jbf-search-category-children').children)[0]
        );

    categorySelector.addEventListener('change', () => {
        let selected = categorySelector.value + '-children';
        categoryChildren.forEach((child) => {
            if(child.id == selected) {
                child.classList.remove('hidden');
            } else {
                child.classList.add('hidden');
            }
        })
    })

})