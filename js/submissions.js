const submissions = document.querySelectorAll('.js-submission-container');

submissions.forEach(submission => {
    const date = submission.querySelector(".date").id;
    const dayName = submission.querySelector(".day").querySelector(".dayName").innerHTML;
    const country = submission.querySelector(".day").querySelector(".country").innerHTML;

    const acceptBut = submission.querySelector(".accept-but");
    const denyBut = submission.querySelector(".deny-but");

    acceptBut.addEventListener("click", () => {
        sendRequest('POST', {
            date,
            dayName,
            country
        })
    });
    denyBut.addEventListener("click", () => {
        sendRequest('DELETE', {
            date,
            dayName,
            country
        })
    });
})

const sendRequest = async (method, data) => {
    console.log(method, JSON.stringify(data));
    await fetch('./includes/submissionCheck.inc.php', {
        method,
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data),
    }).then(res => location.replace(res.url))
    .catch(error => console.log ('something went wrong: ', error));
}