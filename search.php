<div class="search-container">
    <label for="search-input">Hledat práce:</label>
    <form action="results.php" method="GET" class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" name="q" id="search-input" placeholder="Hledat stavební práce, dveře, ..." required autocomplete="off">
        <button type="submit">Hledat</button>
    </form>
    <div id="suggestions" class="suggestions-box"></div> <!-- Našeptávač -->
    <p><a href="nabidka.php">zobrazit všechny práce</a></p>
</div>

<!-- Styl pro našeptávač -->
<style>
    .suggestions-box {
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        width: 100%;
        max-width: 400px;
        display: none;
        z-index: 1000;
        border-radius: 5px;
    }
    .suggestion-item {
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }
    .suggestion-item:hover {
        background: #f1f1f1;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const suggestionsBox = document.getElementById("suggestions");

    searchInput.addEventListener("input", function () {
        let query = searchInput.value.trim();
        if (query.length < 2) {
            suggestionsBox.style.display = "none";
            return;
        }

        fetch("naseptavac.php?q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                suggestionsBox.innerHTML = "";
                if (data.length > 0) {
                    suggestionsBox.style.display = "block";
                    data.forEach(item => {
                        let div = document.createElement("div");
                        div.classList.add("suggestion-item");
                        div.textContent = item.tagy + " - " + item.lokalita; // Použijeme klíčová slova místo jména
                        div.onclick = function () {
                            window.location.href = "results.php?q=" + encodeURIComponent(item.tagy);
                        };
                        suggestionsBox.appendChild(div);
                    });
                } else {
                    suggestionsBox.style.display = "none";
                }
            })
            .catch(error => console.error("Chyba při načítání návrhů:", error));
    });

    // Skrytí našeptávače, když uživatel klikne mimo
    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = "none";
        }
    });
});
</script>


