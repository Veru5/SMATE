function restoreText() {
    var textArea = document.getElementById("text");
    var smazanaHodnota = textArea.getAttribute("data-value"); // Získání poslední smazané hodnoty z atributu
    textArea.value = smazanaHodnota; // Vrácení smazané hodnoty do pole
    }
    // Přiřazení funkce k tlačítku "Back"
    var backButton = document.querySelector('input[value="Back"]');
    backButton.addEventListener('click', restoreText);
    
    
    // DELETE TEXT //
    function deleteText() {
    var textArea = document.getElementById("text");
    var smazanaHodnota = textArea.value; // Uložení aktuální hodnoty textového pole
    textArea.value = ""; // Smazání textu v poli
    textArea.setAttribute("data-value", smazanaHodnota); // Uložení smazané hodnoty do atributu
    }
    
    // CLASSIC //
    function convertToClassic() {
    var inputTextElement = document.getElementById("text");
    var inputText = inputTextElement.value;
    
    function toClassicCase(text) {
        text = text.toLowerCase();
        text = text.replace(/(?:^|\.|\?|!)\s*(\w)/g, function(match, p1) {
            return match.toUpperCase();
        });
        return text;
    }
    
    var classicText = toClassicCase(inputText);
    inputTextElement.value = classicText;
    }
    
    // CAMELCASE //
    function convertToCamelCase() {
    // Získání textu z pole
    var inputTextElement = document.getElementById("text");
    var inputText = inputTextElement.value;
    
    // Funkce pro konverzi textu na CamelCase s mezerami mezi slovy a zachováním celých vět
    function toCamelCaseWithSpaces(text) {
        // Rozdělení textu na věty pomocí teček, otazníků a vykřičníků
        var sentences = text.split(/[.!?]/);
    
        for (var i = 0; i < sentences.length; i++) {
            // Rozdělení každé věty na slova
            var words = sentences[i].trim().split(/\s+/);
            
            for (var j = 0; j < words.length; j++) {
                // První písmeno slova na velké, zbytek malé
                words[j] = words[j].charAt(0).toUpperCase() + words[j].slice(1).toLowerCase();
            }
            
            // Sestavení slov zpět do věty a přidání mezery za každým slovem
            sentences[i] = words.join(" ");
        }
        
        // Sestavení vět zpět do textu
        text = sentences.join(". ");
        
        return text;
    }
    
    // Konverze na CamelCase s mezerami
    var camelCaseText = toCamelCaseWithSpaces(inputText);
    
    // Aktualizace textu v poli
    inputTextElement.value = camelCaseText;
    }
    
    
    // UPPERCAE //
    function convertToUppercase() {
    const textElement = document.getElementById("text");
    const text = textElement.value;
    
    const uppercaseText = text.toUpperCase();
    
    // Aktualizace textu v poli
    textElement.value = uppercaseText;
    }
    
    // LOWERCASE //
    function convertToLowercase() {
    const textElement = document.getElementById("text");
    const text = textElement.value;
    
    const lowercaseText = text.toLowerCase();
    
    // Aktualizace textu v poli
    textElement.value = lowercaseText;
    }
    
    // EMOJI //
    function insertEmoji() {
    var emojiSelect = document.getElementById("emojiSelect");
    var selectedEmoji = emojiSelect.options[emojiSelect.selectedIndex].value;
    var inputTextElement = document.getElementById("text");
    var text = inputTextElement.value;
    var cursorPosition = inputTextElement.selectionStart;
    
    var textBeforeCursor = text.substring(0, cursorPosition);
    var textAfterCursor = text.substring(cursorPosition);
    
    var newText = textBeforeCursor + selectedEmoji + textAfterCursor;
    inputTextElement.value = newText;
    inputTextElement.setSelectionRange(cursorPosition + selectedEmoji.length, cursorPosition + selectedEmoji.length);
    }
    
    var textElement = document.getElementById("text");
    var pocetSlovElement = document.getElementById("pocet_slov");
    var pocetZnakuElement = document.getElementById("pocet_znaku");
    
    textElement.addEventListener("input", function () {
    var text = textElement.value;
    var pocetZnaku = text.length;
    var pocetSlov = text.split(/\s+/).filter(Boolean).length;
    
    pocetSlovElement.textContent = "Počet slov: " + pocetSlov;
    pocetZnakuElement.textContent = "Počet znaků: " + pocetZnaku;
    });