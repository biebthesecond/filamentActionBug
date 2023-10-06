const key = await window.crypto.subtle.generateKey(
    { name: "AES-GCM", length: 128 },
    true, // extractable
    ["encrypt", "decrypt"],
);

const encrypted = await window.crypto.subtle.encrypt(
    {
        name: "AES-GCM",
        iv: new Uint8Array(12) /* don't reuse key! */
    },
    key,
    new TextEncoder().encode(JSON.stringify(content)),
);

const response = await (
    await fetch("/api/upload/encryptedFile", {
        method: "POST",
        body: encrypted,
    })
).json();

const objectURL = response.url;
const objectKey = (await window.crypto.subtle.exportKey("jwk", key)).k;
const url = objectURL + "#key=" + objectKey;
// Example: https://excalidraw.com/?scene=1234#key=BQ1moYESmTEXgtA1KozyVw
