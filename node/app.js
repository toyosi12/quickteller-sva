const curl = require('./modules');

let express = require('express');
let app = express();
let router = express.Router();

app.get('/billers', function(req, res){
    curl.curl('/api/v2/quickteller/billers', res);
})

app.get('/categories', function(req, res){
    curl.curl('/api/v2/quickteller/categorys', res);
})


app.get('/billers_by_category', function(req, res){
    curl.curl('/api/v2/quickteller/categorys/' + 3 + '/billers', res);
})

app.get('/biller_payment_items', function(req, res){
    curl.curl('/api/v2/quickteller/billers/' + 108 + '/paymentitems', res);
})

app.post('/bill_payment_advice', function(req, res){
    paramsObj = {
        TerminalId: '3FTH0001', 
        paymentCode: '10403', 
        customerId: '0000000001', 
        customerMobile: '2348056731576', 
        customerEmail:'toyosioyelayo@nomail.com', 
        amount: 360000, 
        requestReference: '1453' + '' + (Date.now() / 1000 | 0)
    };

    params = JSON.stringify(paramsObj);
    curl.curl('/api/v2/quickteller/payments/advices', res, req.method, params);
})

app.post('/validate_customer', function(req, res){
    paramsArray = {
        customers: [{
            customerId: '07070707089',
            paymentCode: '10804'
        }]
    }
    params = JSON.stringify(paramsArray);
    curl.curl('/api/v2/quickteller/customers/validations', res, req.method, params);
})

app.get('/query_transaction', function(req, res){
    curl.curl('/api/v2/quickteller/transactions?requestreference=sdfju8sdf', res);
})

app.get('/get_banks', function(req, res){
    curl.curl('/api/v2/quickteller/configuration/fundstransferbanks', res);
})

app.post('/do_transfer', function(req, res){
    curl.curl('/api/v2/quickteller/payments/transfers', res, req.method, params);
})

app.get('/validate_name', function(req, res){
    curl.curl('/api/v1/nameenquiry/banks/accounts/names?bankCode=' + bankCode + '&accountId=' + $accountId, res);
})



app.listen(3001, () => {
    console.log('listening on port 3001');
})