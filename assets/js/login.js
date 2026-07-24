const translations = loginTranslations;

document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginForm = document.getElementById('loginForm');
    const alertContainer = document.getElementById('alertContainer');
    const submitButton = document.getElementById('loginButton');
    const togglePassword = document.getElementById('togglePassword');
    const languageButtons = document.querySelectorAll('.language-toggle');

    const textElements = {
        headingTitle: document.getElementById('headingTitle'),
        headingSubtitle: document.getElementById('headingSubtitle'),
        labelRole: document.getElementById('labelRole'),
        labelUsername: document.getElementById('labelUsername'),
        labelPassword: document.getElementById('labelPassword'),
        labelRemember: document.getElementById('labelRemember'),
        loginButton: submitButton,
        forgotText: document.getElementById('forgotText'),
        supportText: document.getElementById('supportText'),
        langEn: document.getElementById('langEn'),
        langMr: document.getElementById('langMr')
    };

    const defaultOptions = Array.from(roleSelect.options).map(option => ({
        value: option.value,
        textEn: option.dataset.textEn || option.textContent,
        textMr: option.dataset.textMr || option.textContent
    }));

    const credentials = {
        'Village/Gram Panchayat User': { username: 'village', password: 'village1234' },
        'Engineer/Verifier': { username: 'engineer', password: 'engineer1234' },
        'Taluka Officer': { username: 'taluka', password: 'taluka1234' },
        'District/CEO Authority': { username: 'district', password: 'district1234' },
        'System Administrator': { username: 'admin', password: 'admin123' }
    };

    let currentLanguage = sessionStorage.getItem('siteLanguage') || 'en';

    function showAlert(type, message) {
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    }

    function clearAlert() {
        alertContainer.innerHTML = '';
    }

    function setLoading(isLoading) {
        if (isLoading) {
            submitButton.disabled = true;
            submitButton.innerHTML = `${translations[currentLanguage].loginButton} <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        } else {
            submitButton.disabled = false;
            submitButton.textContent = translations[currentLanguage].loginButton;
        }
    }

    function setLanguage(lang) {
        currentLanguage = lang;
        sessionStorage.setItem('siteLanguage', lang);
        const strings = translations[lang];

        textElements.headingTitle.textContent = strings.headingTitle;
        textElements.headingSubtitle.textContent = strings.headingSubtitle;
        textElements.labelRole.textContent = strings.labelRole;
        textElements.labelUsername.textContent = strings.labelUsername;
        textElements.labelPassword.textContent = strings.labelPassword;
        textElements.labelRemember.textContent = strings.labelRemember;
        textElements.loginButton.textContent = strings.loginButton;
        textElements.forgotText.textContent = strings.forgotPassword;
        textElements.supportText.textContent = strings.supportText;
        textElements.langEn.textContent = strings.langEn;
        textElements.langMr.textContent = strings.langMr;
        usernameInput.placeholder = translations[lang].labelUsername;
        passwordInput.placeholder = translations[lang].labelPassword;

        const currentRole = roleSelect.value;
        roleSelect.options.length = 0;
        defaultOptions.forEach(item => {
            const option = document.createElement('option');
            option.value = item.value;
            option.textContent = item[`text${lang === 'mr' ? 'Mr' : 'En'}`];
            option.dataset.textEn = item.textEn;
            option.dataset.textMr = item.textMr;
            if (item.value === currentRole) {
                option.selected = true;
            }
            roleSelect.appendChild(option);
        });

        languageButtons.forEach(button => {
            button.classList.toggle('active', button.dataset.lang === lang);
        });
    }

    languageButtons.forEach(button => {
        button.addEventListener('click', function () {
            setLanguage(button.dataset.lang);
        });
    });

    // Entrance animation trigger for brand and card
    function runEntranceAnimation() {
        const hero = document.querySelector('.brand-hero');
        const list = document.querySelector('.brand-list');
        const card = document.querySelector('.login-card');
        if (hero) setTimeout(() => hero.classList.add('animate'), 60);
        if (list) setTimeout(() => list.classList.add('animate'), 180);
        if (card) setTimeout(() => card.classList.add('animate'), 260);
    }

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();
        clearAlert();

        const role = roleSelect.value.trim();
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (!role || !username || !password) {
            showAlert('warning', translations[currentLanguage].validationComplete);
            return;
        }

        if (!credentials[role]) {
            showAlert('danger', translations[currentLanguage].validationRole);
            return;
        }

        const expected = credentials[role];
        if (username !== expected.username || password !== expected.password) {
            showAlert('danger', translations[currentLanguage].validationLogin);
            return;
        }

        setLoading(true);
        setTimeout(function () {
            sessionStorage.setItem('userRole', role);
            sessionStorage.setItem('userName', username);
            sessionStorage.setItem('isLoggedIn', 'true');
            showAlert('success', translations[currentLanguage].successLogin);

            const routeMap = {
                'Village/Gram Panchayat User': 'dashboard/village',
                'Engineer/Verifier': 'dashboard/engineer',
                'Taluka Officer': 'dashboard/taluka',
                'District/CEO Authority': 'dashboard/district',
                'System Administrator': 'dashboard/admin'
            };

            const destination = routeMap[role] || 'dashboard/village';
            setTimeout(() => {
                window.location.href = destination;
            }, 900);
        }, 1200);
    });

    setLanguage(currentLanguage);
    // start the entrance animation after language strings and DOM wiring are ready
    runEntranceAnimation();
});
