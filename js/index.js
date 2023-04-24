(function () {
    const selectAll = document.querySelectorAll('.select');

    if (!selectAll?.length) return;

    selectAll.forEach(select => {
        const selecInputBlock = select.querySelector('.select__input-block');
        const selecInput = select.querySelector('.select__input');
        const selectItemAll = select.querySelectorAll('.select__item');

        selecInputBlock.onclick = () => {
            select.classList.toggle('_active');
        };

        selectItemAll.forEach(selectItem => {
            selectItem.onclick = function () {
                selecInput.value = this.textContent;

                if (!select.classList.contains('_active')) return;

                select.classList.remove('_active');
            }
        })
    })
})();