
export function adminIsLoggedIn() {
    //check  admin is login ?
    return localStorage.getItem("adminIsLoggedIn") == "true";
}

export function adminlogIn() {
    return localStorage.setItem("adminIsLoggedIn", true);
}

export function adminlogOut() {
    return localStorage.setItem("adminIsLoggedIn", false);
}



export function userIsLoggedIn() {
    //check  user is login ?
    return localStorage.getItem("userIsLoggedIn") == "true";
}

export function userlogIn() {
    return localStorage.setItem("userIsLoggedIn", true);
}

export function userlogOut() {
    return localStorage.setItem("userIsLoggedIn", false);
}
