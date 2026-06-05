document.addEventListener('DOMContentLoaded', () => {

    const tabButtons = document.querySelectorAll('.tab-btn');

    function setActiveTab(button) {

        tabButtons.forEach(btn => {

            btn.classList.remove(
                'bg-lime-400',
                'text-gray-900'
            );

            btn.classList.add(
                'text-gray-500',
                'hover:bg-gray-100'
            );

        });

        button.classList.remove(
            'text-gray-500',
            'hover:bg-gray-100'
        );

        button.classList.add(
            'bg-lime-400',
            'text-gray-900'
        );
    }

    tabButtons.forEach(button => {

        if (button.classList.contains('active-tab')) {
            setActiveTab(button);
        }

        button.addEventListener('click', () => {
            setActiveTab(button);
        });

    });

});