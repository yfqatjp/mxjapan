<!--#include file = "../../DBConn/com.asp"-->
<%
Dim objHttp, str, Item_name, Item_number, Payment_status, Payment_amount
Dim Payment_currency, Txn_id, Receiver_email, Payer_email
Dim business, quantity, invoice, custom, tax, option_name1
Dim option_selection1, option_name2, option_selection2, num_cart_items
Dim pending_reason, payment_date, mc_gross, mc_fee, mc_currency
Dim settle_amount, settle_currency, exchange_rate, txn_type
Dim first_name, last_name, address_name, address_street, address_city
Dim address_state, address_zip, address_country, address_status
Dim payer_id, payer_status, payment_type, notify_version
Dim verify_sign
Dim subscr_date, period1, period2, period3, amount1, amount2, amount3
Dim recurring, reattempt, retry_at, recur_times, username, password, subscr_id
 
'read post from PayPal system and add 'cmd'
str = Request.Form & "&cmd=_notify-validate"
 
'post back to PayPal system to validate
'set objHttp = Server.CreateObject("Msxml2.ServerXMLHTTP")
'set objHttp = Server.CreateObject("Msxml2.ServerXMLHTTP.4.0")
set objHttp = Server.CreateObject("Microsoft.XMLHTTP")
'objHttp.open "POST", "https://www.sandbox.paypal.com/cgi-bin/webscr", false
objHttp.open "POST", "https://www.paypal.com/cgi-bin/webscr", false
objHttp.setRequestHeader "Content-type", "application/x-www-form-urlencoded"
objHttp.Send str

'assign posted variables to database
Item_name = Request.Form("item_name")
Item_number = Request.Form("item_number")
Txn_id = Request.Form("txn_id")
Receiver_email = Request.Form("receiver_email")
Payer_email = Request.Form("payer_email")
Payment_amount = Request.Form("mc_gross")
payment_status = Request.Form("payment_status")
Payment_currency = Request.Form("mc_currency")
first_name = Request.Form("first_name")
last_name = Request.Form("last_name")
payer_status = Request.Form("payer_status")
txn_id = Request.Form("txn_id")
address_street = Request.Form("address_street")
address_city = Request.Form("address_city")
address_state = Request.Form("address_state")
address_zip = Request.Form("address_zip")
address_country = Request.Form("address_country")
mc_gross = Request.Form("mc_gross")
mc_fee = Request.Form("mc_fee")
mc_currency = Request.Form("mc_currency")
business = Request.Form("business")

'Check notification validation
if (objHttp.status <> 200 ) then
'HTTP error handling
elseif payment_status = "Refunded" then
'//更改订单状态
sql = "update web_orders set rejectStatus=5,dealStatus=5 where orderNum = '"&item_number&"'"
conn.execute sql
Response.end

elseif (objHttp.responseText = "VERIFIED") then
set rs0 = server.CreateObject("adodb.recordset")
sql = "select * from Web_Orders where orderNum = '"&Item_number&"'"
rs0.open sql,conn,1,1
if rs0("Logistics") = 0 then
sql = "update Web_funds set ed = 3 where orderNum like '"&Item_number&"')"'卖家入账
conn.execute sql

sql = "update Web_Member set points = points + "&rs0("dealPrice")&" where id = "&rs0("uid")&""
conn.execute sql
else
'//更改订单状态
sql = "update web_orders set returnNum = '"&Txn_id&"',buyEmail='"&Payer_email&"',dealStatus=1,payDate=Date() where orderNum = '"&Item_number&"'"
conn.execute sql

set rs = server.CreateObject("adodb.recordset")
sql = "select * from Web_cart where orderNum like '"&Item_number&"'"
rs.open sql,conn,1,1
do while not rs.eof

sql = "select * from Web_product where id = "&rs("pid")&""
call openRS1(sql,1)

zong = ccur(rs("jiage"))*ccur(rs("shu"))+ccur(rs("freight"))

sql = "INSERT INTO Web_funds (uid,jiage,ed,tid,orderNum) VALUES ("&rs("uid")&","&zong&",1,1,'"&Item_number&"')"'买家支出
conn.execute sql

sql = "INSERT INTO Web_funds (uid,jiage,ed,tid,orderNum) VALUES ("&usershop(rs1("uid"),3)&","&zong&",0,0,'"&Item_number&"')"'卖家入账
conn.execute sql

sql = "update Web_Member set dongjie = dongjie + "&zong&" where id = "&usershop(rs1("uid"),3)&""
conn.execute sql
rs.MoveNext
loop

sql = "delete FROM Web_buy where uid = "&session("userID")&""
conn.execute sql
end if
'check that Payment_status=Completed
'check that Txn_id has not been previously processed
'check that Receiver_email is your Primary PayPal email
'check that Payment_amount/Payment_currency are correct
'process payment
elseif (objHttp.responseText = "INVALID") then
'log for manual investigation

 
response.write ("PayPal's response to this IPN was: ") & "<b>" & objHttp.responseText & "</b><p>"
response.write ("<hr>") & "<br>"
 
response.write ("Item Name: ") & item_name & "<br>"
response.write ("Item Number: ") & item_number & "<br>"
response.write ("Payment Status: ") & payment_status & "<br>"
response.write ("MC Gross: ") & mc_gross & "<br>"
response.write ("MC Currency: ") & mc_currency & "<br>"
response.write ("TXN ID: ") & txn_id & "<br>"
response.write ("Receiver Email: ") & receiver_email & "<br>"
response.write ("Payer Email: ") & payer_email & "<br>"
response.write ("Business: ") & business & "<br>"
response.write ("Quantity: ") & quantity & "<br>"
response.write ("Invoice: ") & invoice & "<br>"
response.write ("Custom: ") & custom & "<br>"
response.write ("Tax: ") & tax & "<br>"
response.write ("Option Name1: ") & option_name1 & "<br>"
response.write ("Option Selection1: ") & option_selection1 & "<br>"
response.write ("Option Name2: ") & option_name2 & "<br>"
response.write ("Option Selection2: ") & option_selection2 & "<br>"
response.write ("Num Cart Items: ") & num_cart_items & "<br>"
response.write ("Pending Reason: ") & pending_reason & "<br>"
response.write ("Payment Date: ") & payment_date & "<br>"
response.write ("MC Gross: ") & mc_gross & "<br>"
response.write ("MC Fee: ") & mc_fee & "<br>"
response.write ("MC Currency: ") & mc_currency  & "<br>"
response.write ("Settle Amount: ") & settle_amount & "<br>"
response.write ("Settle Currency: ") & settle_currency & "<br>"
response.write ("Exchange Rate: ") & exchange_rate & "<br>"
response.write ("TXN Type: ") & txn_type & "<br>"
response.write ("First Name: ") & first_name & "<br>"
response.write ("Last Name: ") & last_name & "<br>"
response.write ("Address Name: ") & address_name & "<br>"
response.write ("Address Street: ") & address_street & "<br>"
response.write ("Address City: ") & address_city & "<br>"
response.write ("Address State: ") & address_state & "<br>"
response.write ("Address Zip: ") & address_zip & "<br>"
response.write ("Address Country: ") & address_country & "<br>"
response.write ("Address Status ") & address_status & "<br>"
response.write ("Payer Email: ") & payer_email & "<br>"
response.write ("Payer ID: ") & payer_id & "<br>"
response.write ("Payer Status: ") & payer_status & "<br>"
response.write ("Payer Type: ") & payment_type & "<br>"
response.write ("Notify Version: ") & notify_version & "<br>"
response.write ("Verify Sign: ") & verify_sign & "<p></p>"
response.write ("<hr>") & "<br>"

response.write ("<b>Subscription Variables/Values</b><br>")

 
response.write ("Subscr Date: ") & subscr_date & "<br>"
response.write ("Period1: ") & period1 & "<br>"
response.write ("Period2: ") & period2 & "<br>"
response.write ("Period3: ") & period3 & "<br>"
response.write ("Amount1: ") & amount1 & "<br>"
response.write ("Amount2: ") & amount2 & "<br>"
response.write ("Amount3: ") & amount3 & "<br>"
response.write ("Recurring ") & recurring & "<br>"
response.write ("Reattempt ") & reattempt & "<br>"
response.write ("Retry At ") & retry_at & "<br>"
response.write ("Recur Times ") & recur_times & "<br>"
response.write ("Username ") & username & "<br>"
response.write ("Password ") & password & "<br>"
response.write ("Subscr ID ") & subscr_id & "<br>"

else
'error
end if
set objHttp = nothing
%>

