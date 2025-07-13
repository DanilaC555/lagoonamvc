document.addEventListener('DOMContentLoaded', function(){

  document.getElementById("searchButton").addEventListener("click", function() {
    var searchText = document.getElementById("searchInput").value.toLowerCase();
    var textToSearch = "Лучшие предложения по выгодной цене. ";

    var searchResults = document.getElementById("searchResults");
    searchResults.innerHTML = ''; // Очищаем результаты предыдущего поиска

    var words = textToSearch.split(' ');
    for (var i = 0; i < words.length; i++) {
      if (words[i].toLowerCase() === searchText) {
        var match = document.createElement('placement-title');
        match.textContent = words[i] + ' ';
        match.style.backgroundColor = 'yellow'; // Стилизуем найденные слова
        searchResults.appendChild(match);
      } else {
        searchResults.innerHTML += words[i] + ' ';
      }
    }
  });
})
