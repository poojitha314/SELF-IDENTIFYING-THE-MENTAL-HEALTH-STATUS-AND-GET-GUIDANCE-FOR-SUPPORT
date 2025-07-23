let currentStep = 1;
let selectedImage = "";

document.addEventListener('DOMContentLoaded', (event) => {
    showStep(currentStep);
});

function showStep(step) {
    document.querySelectorAll('.question-step').forEach((el) => {
        el.classList.remove('active');
    });
    document.getElementById(`questionStep${step}`).classList.add('active');
}

function nextQuestion(step) {
    if (step === 1 && !document.getElementById('age').value) {
        alert("Please enter the age.");
        return;
    }
    showStep(step + 1);
}

function selectImage(image) {
    selectedImage = image;
    document.querySelectorAll('.image-options img').forEach((img) => {
        img.classList.remove('selected');
    });
    document.querySelector(`.image-options img[alt="${image.charAt(0).toUpperCase() + image.slice(1)}"]`).classList.add('selected');
}

function analyzeMentalHealth() {
    const age = document.getElementById('age').value;
    const anxiety = document.getElementById('anxiety').value;
    const concentration = document.getElementById('concentration').value;
    const sadness = document.getElementById('sadness').value;

    let result = "Mental Health Analysis Result:\n";

    if (age && anxiety && concentration && sadness && selectedImage) {
        let score = 0;

        // Simple scoring mechanism
        score += getScore(anxiety);
        score += getScore(concentration);
        score += getScore(sadness);

        // Image scoring
        if (selectedImage === 'happy') {
            score += 0;
        } else if (selectedImage === 'neutral') {
            score += 2;
        } else if (selectedImage === 'sad') {
            score += 4;
        }

        if (score <= 5) {
            result += "Your child seems to be doing well.";
        } else if (score <= 10) {
            result += "Your child might be experiencing some mental health challenges.";
        } else {
            result += "Your child might be experiencing significant mental health challenges. Consider seeking professional help.";
        }
        
        document.getElementById('activitiesLink').style.display = 'block';
    } else {
        result = "Please fill out all fields.";
    }

    document.getElementById('result').innerText = result;
}

function getScore(value) {
    switch (value) {
        case 'never': return 0;
        case 'rarely': return 1;
        case 'sometimes': return 2;
        case 'often': return 3;
        case 'always': return 4;
        default: return 0;
    }
}
