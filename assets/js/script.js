document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            if (alert && alert.parentNode) {
                alert.classList.remove('show');
                alert.classList.add('fade');
            }
        }, 6000);
    });

    const revealItems = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    revealItems.forEach(function (item) {
        observer.observe(item);
    });

    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(function (stat) {
        const target = parseInt(stat.getAttribute('data-target'), 10);
        const duration = 1400;
        let startTime = null;

        const step = function (timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            const current = Math.floor(progress * target);
            stat.textContent = current.toLocaleString();

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                stat.textContent = target.toLocaleString();
            }
        };

        const statObserver = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    window.requestAnimationFrame(step);
                    obs.disconnect();
                }
            });
        }, { threshold: 0.6 });

        statObserver.observe(stat);
    });
});
