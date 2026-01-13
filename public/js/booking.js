const calendarGrid = document.getElementById('calendarGrid');
const monthDisplay = document.getElementById('monthDisplay');
const dateInput = document.getElementById('final-date-input');

let currentNavDate = new Date();
const today = new Date();
today.setHours(0, 0, 0, 0);

// 1. CAPTURE SERVICE FROM URL
const params = new URLSearchParams(window.location.search);
const service = params.get('service');

if (service) {
    // Updates UI display
    document.getElementById('service-text').innerText = service.replace(/-/g, ' ').toUpperCase();
    // Pre-fills hidden input for Laravel
    document.getElementById('service-slug').value = service;
}

// 2. CALENDAR LOGIC
function renderCalendar() {
    calendarGrid.innerHTML = '';
    const year = currentNavDate.getFullYear();
    const month = currentNavDate.getMonth();

    monthDisplay.innerText = new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(currentNavDate);

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
        calendarGrid.appendChild(document.createElement('div'));
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.innerText = day;

        const checkDate = new Date(year, month, day);

        if (checkDate < today) {
            dayElement.classList.add('past');
        } else {
            dayElement.onclick = () => {
                document.querySelectorAll('.day').forEach(d => d.classList.remove('selected'));
                dayElement.classList.add('selected');
                // Format for Laravel database: YYYY-MM-DD
                dateInput.value = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            };
        }
        calendarGrid.appendChild(dayElement);
    }
}

document.getElementById('prevMonth').onclick = () => {
    currentNavDate.setMonth(currentNavDate.getMonth() - 1);
    renderCalendar();
};

document.getElementById('nextMonth').onclick = () => {
    currentNavDate.setMonth(currentNavDate.getMonth() + 1);
    renderCalendar();
};

renderCalendar();