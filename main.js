let urlButton = document.getElementById("URL");
urlButton.onclick = async () => {
    let url = new URL(window.location.href);
    url.pathname = "/AvangardPHP/request.php";
    console.log("from url button = ", url.toString());
    await makeRequest(url);
//    const result = await makeRequest(url);
//    console.log("url result = ", result);
}

const makeRequest = async (url) => {
    let dataToSend = {'data': 'some data'};
    const request = new Request(url, {
                                method: "POST",
                                headers: {
                                            'Content-Type': 'application/json;charset=utf-8',

                                        },
                                body: JSON.stringify(dataToSend)
                                });
    try {
        const response = await fetch(request);  
        if (!response.ok) {
            throw new Error(response.statusText);
        }
        const data = await response.json();
        console.log("url result = ", data);

    }
    catch(error) {
        console.log(error);
    }
    
//    return data;
}

