<div id="page-wrapper">
        <label for="items">Type in a Spell, Feat, Magic Item, or Monster</label>
<form method="get" action="search.php">
        <input type="text" id="items" items="search" list="items" >
        <datalist id="items" />
</form>
</div>

<script type="text/javascript">

document.querySelector('input[list="items"]').addEventListener('input', onInput);

function onInput(e) {
   var input = e.target,
       val = input.value;
       list = input.getAttribute('list'),
       options = document.getElementById(list).childNodes;


// Get the <datalist> and <input> elements.
var dataList = document.getElementById('items');
var input = document.getElementById('items');

// Create a new XMLHttpRequest.
var request = new XMLHttpRequest();

// Handle state changes for the request.
request.onreadystatechange = function(response) {
  if (request.readyState === 4) {
    if (request.status === 200) {
      // Parse the JSON
      var jsonOptions = JSON.parse(request.responseText);

      // Loop over the JSON array.
      jsonOptions.forEach(function(item) {
        // Create a new <option> element.
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        option.value = item;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);
      });

      // Update the placeholder text.
      input.placeholder = "e.g. Fireball, Message, etc.";
    } else {
      // An error occured :(
      input.placeholder = "Couldn't load datalist options :(";
    }
  }
};

// Update the placeholder text.
input.placeholder = "Loading options...";

// Set up and make the request.
request.open('GET', 'https://pathfinder.brigzzy.net/test.json', true);
request.send();

  for(var i = 0; i < options.length; i++) {
    if(options[i].innerText === val) {
      // An item was selected from the list!
      // yourCallbackHere()
      alert('item selected: ' + val);
      break;
    }
  }
}

</script>
