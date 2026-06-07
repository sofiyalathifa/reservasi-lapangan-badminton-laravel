document.addEventListener("DOMContentLoaded", () => {
    const tabButtons = document.querySelectorAll(".tab-btn");
    const searchInput = document.getElementById("searchInput");
    const items = document.querySelectorAll(".lapangan-item");
    let currentType = "semua";
    let currentSearch = "";

    function setActiveTab(button) {
        tabButtons.forEach((btn) => {
            btn.classList.remove("bg-lime-400", "text-gray-900");

            btn.classList.add("text-gray-500", "hover:bg-gray-100");
        });

        button.classList.remove("text-gray-500", "hover:bg-gray-100");

        button.classList.add("bg-lime-400", "text-gray-900");
    }

    function filterItems() {
        items.forEach((item) => {
            const itemType = item.getAttribute("data-tipe") || "";
            const itemName = item.getAttribute("data-nama") || "";

            const matchType =
                currentType === "semua" || itemType === currentType;
            const matchSearch = itemName.includes(currentSearch);

            if (matchType && matchSearch) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });

        // Beritahu carousel untuk menghitung ulang jumlah item yang terlihat
        if (typeof window.refreshCarousel === "function") {
            window.refreshCarousel();
        }
    }

    tabButtons.forEach((button) => {
        if (button.classList.contains("active-tab")) {
            setActiveTab(button);
            currentType = button.getAttribute("data-type").toLowerCase();
        }

        button.addEventListener("click", () => {
            setActiveTab(button);
            currentType = button.getAttribute("data-type").toLowerCase();
            filterItems();
        });
    });

    if (searchInput) {
        searchInput.addEventListener("input", (e) => {
            currentSearch = e.target.value.toLowerCase();
            filterItems();
        });
    }
});
