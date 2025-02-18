(function() {
    const trackingEndpoint = "http://localhost:8080/api/track";

    function getSessionId() {
        if (!localStorage.getItem("session_id")) {
            localStorage.setItem("session_id", Math.random().toString(36).substring(2));
        }
        return localStorage.getItem("session_id");
    }

    function trackVisit() {
        const data = {
            page_url: window.location.href,
            user_agent: navigator.userAgent,
            session_id: getSessionId(),
        };

        fetch(trackingEndpoint, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => console.log("Tracking success:", data))
            .catch(error => console.error("Tracking failed:", error));
    }

    trackVisit();
})();
