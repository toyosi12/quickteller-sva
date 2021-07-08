const clientId = 'IKIA83BDD0B659E353A289D5AD5AD97936608DD75072';
const secretKey = '8q0S5VwkQ0vpWMA4RjEvnsFt5k2+EtzQ1fDb3WOE/48=';
let authorizationString;
let nonce;
let timeStamp;
const signatureMethod = 'SHA1';
const terminalId = '3DMO0001';

const https = require('https');


let hostname = 'sandbox.interswitchng.com';
let crypto = require('crypto');

authorizationString = computeAuthorizationString();
timeStamp = computeTimeStamp();

function curl(path, res, method='GET', params = '{}', headers = {}){
    nonce = computeNonce();
    let data = '';
    let fullPath = 'https://' + hostname + path;
    
    const options = {
        hostname,
        port: 443,
        path,
        method,
        headers: {
            Authorization: authorizationString,
            'Content-Type': 'application/json',
            'Signature': computeSignature(fullPath, method),
            'Timestamp': timeStamp,
            'Nonce': nonce,
            'TerminalID': terminalId,
            'SignatureMethod': signatureMethod
        }
    };


    const request = https.request(options, response => {
        response.on('data', (chunk) => {
            data += chunk;
        })

        response.on('end', () => {
            res.send(JSON.parse(data));
        });

    }).on('error', error => {
        console.log('error: ', error);
    });

    if(method === 'POST'){
        request.write(params);
    }
    request.end();
}



function computeTimeStamp(){
    return Date.now() / 1000 | 0;
}

function computeNonce(length = 32){
    let nonce = '';
    let characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let charactersLength = characters.length;
    for(let i = 0; i < length; i++){
        nonce += characters[Math.floor(Math.random() * charactersLength) + 1];
    }
    return nonce;
}

function computeAuthorizationString(endpoint, method = 'GET'){
    return 'InterswitchAuth ' + Buffer.from(clientId).toString('base64')
}

function computeSignature(endpoint, method){
    method = method.toUpperCase();
    let signature = method + '&' + encodeURIComponent(endpoint) + '&'
                    + timeStamp + '&' + nonce + '&' + clientId + '&'
                    + secretKey;
    let hashedSignature = crypto.createHash('sha1').update(signature).digest('base64');
    return hashedSignature;
}

exports.curl = curl;