// const
// const signatureForm = document.getElementById("floors-units-sales-plan-table-form");
const signatureForm = document.querySelector(".signature-form");
        const signaturePad = new SignaturePad(document.getElementById("signature"), {
            syncField: '#signature',
        });

        let isSignatureTaken = true;
        // Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
        signaturePad.toDataURL(); // save image as PNG


        // Returns signature image as an array of point groups
        const data = signaturePad.toData();


        // Draws signature image from an array of point groups, without clearing your existing image (clear defaults to true if not provided)
        signaturePad.fromData(data, {
            clear: false
        });

        // Clears the canvas
        signaturePad.clear();

        // Returns true if canvas is empty, otherwise returns false
        signaturePad.isEmpty();

        // Unbinds all event handlers
        signaturePad.off();

        // Rebinds all event handlers
        signaturePad.on();
        const nextStepAuthButton = document.getElementById("nextStepAuth");

        nextStepAuthButton.addEventListener("click", () => {
            if (isSignatureTaken) {
                signaturePad.clear();
                isSignatureTaken = true; // Reset the flag
            }
        });
        const clearButton = document.getElementById("clear");

        clear.addEventListener("click", () => {
            signaturePad.clear();
        });


        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            // canvas.width = canvas.offsetWidth * ratio;
            // canvas.height = canvas.offsetHeight * ratio;
            // canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear(); // otherwise isEmpty() might return incorrect value
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();




    // var sig = $('#signature').SignaturePad({
    //     syncField: '#signature',
    //     syncFormat: 'PNG'
    // });
    // $('.touch-enable').draggable();

    $('.signature-form').on('submit', function(event) {
        event.preventDefault();

        var imageData = $('#signature').val();
        const signatureDataUrl = signaturePad.toDataURL();

        // Set the signature image data as the value of the hidden input field
        const inputField = document.createElement('input');
        inputField.setAttribute('type', 'hidden');
        inputField.setAttribute('name', 'signed');
        inputField.setAttribute('value', signatureDataUrl);
            // console.log(signatureDataUrl);

        // Append the hidden input field to the form
        $(this).append(inputField);

        // Submit the form
        $(this).unbind('submit').submit();
        // isSignatureTaken = true;

    });
