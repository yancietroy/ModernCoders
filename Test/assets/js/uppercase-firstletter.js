// Get a reference to the input and wire it up to an input event handler that
// calls the fixer function
document.getElementById("txtTest").addEventListener("input", forceLower);
document.getElementById("txtTest2").addEventListener("input", forceLower);
document.getElementById("txtTest3").addEventListener("input", forceLower);
// Event handling functions are automatically passed a reference to the
// event that triggered them as the first argument (evt)
function forceLower(evt) {
  // Get an array of all the words (in all lower case)
  var words = evt.target.value.toLowerCase().split(/\s+/g);

  // Loop through the array and replace the first letter with a cap
  var newWords = words.map(function (element) {
    // As long as we're not dealing with an empty array element, return the
    // first letter of the word, converted to upper case and add the rest of the
    // letters from this word. Return the final word to a new array
    return element !== ""
      ? element[0].toUpperCase() + element.substr(1, element.length)
      : "";
  });

  // Replace the original value with the updated array of capitalized words.
  evt.target.value = newWords.join(" ");
}
