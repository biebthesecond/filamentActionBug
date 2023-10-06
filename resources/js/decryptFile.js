const response = await fetch(`/download?id={id}`);
const encrypted = await response.arrayBuffer();

const objectKey = window.location.hash.slice("#key=".length);
const key = await window.crypto.subtle.importKey(
    "jwk",
    {
        k: objectKey,
        alg: "A128GCM",
        ext: true,
        key_ops: ["encrypt", "decrypt"],
        kty: "oct",
    },
    { name: "AES-GCM", length: 128 },
    false, // extractable
    ["decrypt"],
);

const decrypted = await window.crypto.subtle.decrypt(
    { name: "AES-GCM", iv: new Uint8Array(12) },
    key,
    encrypted,
);

const decoded = new window.TextDecoder().decode(new Uint8Array(decrypted));
const content = JSON.parse(decoded);
