let urlButton = document.getElementById("URL");
let resultButton = document.getElementById("Copy");

urlButton.onclick = async () => {
    let url = new URL(window.location.href);
    url.pathname = "/AvangardPHP/request.php";
    await makeRequest(url);
}

const makeRequest = async (url) => {
    let dataToSend = {'data': document.getElementById("Uname").value};
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
            throw new Error(`Response status: ${response.status}`);
        }
        const data = await response.json();
        console.log("url result = ", data.data);
        document.getElementById("UResult").value = data.data;
        document.getElementById("Uname").value = "";
        console.log(data);
    }
    catch(error) {
        console.log(error.message);
    }
    
}

resultButton.onclick = () => {
  let copyText = document.getElementById("UResult");
  copyText.select();
  navigator.clipboard.writeText(copyText.value);
}

