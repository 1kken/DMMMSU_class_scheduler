<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Simple Search</title>
</head>
<body>
<h2>Search for Something</h2>
<input type="text" id="searchInput" placeholder="Enter search term">
<button onclick="search()">Search</button>
<div id="searchResult"></div>

<script>
function search() {
    var searchTerm = document.getElementById("searchInput").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("searchResult").innerHTML = xhr.responseText;
            } else {
                alert('Error: ' + xhr.status);
            }
        }
    };
    xhr.open("GET", "../jqueries/getData.php?q=" + encodeURIComponent(searchTerm), true);
    xhr.send();
}
</script>
</body>
</html>
