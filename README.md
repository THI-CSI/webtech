# webtec
All group work and a summary of the web-technologies lecture at THI in the winter semester 2023/24 resides here.

## Structure
```
.
├── README.md
├── SGML
│   ├── example.html
│   ├── example.xml
│   ├── example.xsl
│   ├── external-dtd-example.xml
│   ├── external.dtd
│   ├── internal-dtd-example.xml
│   └── simple.html
├── Virtual-Web-Servers
│   ├── IPbased
│   │   ├── hosts
│   │   └── httpd.conf
│   ├── Namebased
│   │   ├── hosts
│   │   └── httpd.conf
│   └── Portbased
│       ├── hosts
│       └── httpd.conf
├── basic-calculator.html
├── injection-web-proxy.py
├── minimal-web-proxy.py
├── minimal-web-server.py
└── node
    ├── hosts
    ├── minimal-web-proxy.js
    ├── minimal-web-server.js
    └── rest-api-server.js
```
## Summary

WIP

## Group Work 1
### Task
Implement a tiny webserver that fulfills the following requirements:
- accepts connections on port 80
- no SSL/TLS
- supports only GET on HTTP/1.1
- ignores all headers but the Host header

### Solution
`./minimal-web-server.py`

### Usage
1. Start a shell and run `python minimal-web-server.py`
2. Open a browser and type `localhost:80` into the addressbar
2. Start a second shell and run `curl localhost:80`

## Group Work 2
### Task
Implement a tiny proxy that fulfills the following requirements:
- safe everything that is passed through
- no SSL/TLS

### Solution
`./minimal-web-proxy.py`

### Usage
1. Start a shell and run `python minimal-web-proxy`
2. Start a second shell and run `curl -x localhost:80 example.com`
3. Repeat step 2 a vew times with diffrent web pages
4. Go back in the first shell and stop the proxy via `ctrl + c`
5. Take a look at the produced files `request.txt` and `response.txt`

## Group Work 3
### Task
1. Create a simple web page in HTML/4.01
2. Create a internal and external DTD for `./SGML/example.xml`
3. Create an XSL to transform `./SGML/example.xml` in HTML/4.01
4. Transform `./SGML/example.xml` using the XSL from 3. and make it an XHTML document

### Solution
`./SGML`
1. `./SGML/simple.html`
2. `./SGML/internal-dtd-example.xml`, `./SGML/external.dtd`, `./SGML/external-dtd-example.xml`
3. `./SGML/example.xsl`
4. `./SGML/example.html`

### Usage
1. Open `./SGML/simple.html` with a browser
2. \-
3. \-
4. Transformation
    1. Go to http://xsltransform.net/ and paste the contents of `./SGML/example.xml` and `./SGML/example.xsl` accordingly
    2. Safe the result with a html file extension e.g. `example.html`
    3. Open `example.html` with a browser
    4. One can transform `example.html` into an XHTML conform document with minor adjustments (should look like `./SGML/example.html`)

## Group Work 4
### Task
Create a simple web page in HTML that provides a basic calculator (supports + - * /) by embedding JavaScript code.

### Solution
`./basic-calculator.html`

### Usage
1. Open `./basic-calculator.html` with a browser

### Addition
One can use a proxy to inject anything into the http response here is an example proxy `./injection-web-proxy.py`. It is based on `./minimal-web-proxy.py` from **Group Work 2** and injects the calculator into an html page served via http.

**Usage:**
1. Start a shell end run `python injection-web-proxy.py`
2. Start a second shell and`curl -x localhost:8080 example.com > modifiedExample.html`
3. Open `./modifiedExample.html` with a browser

## Group Work 5
### Task
Create 2 virtual webservers with httpd within an OpenBSD virtual machine using the following techniques:
1. Name based hosting
2. IP based hosting
3. Port based hosting

### Solution
`./Virtual-Web-Servers`
1. `./Virtual-Web-Servers/Namebased`
2. `./Virtual-Web-Servers/IPbased`
3. `./Virtual-Web-Servers/Portbased`

### Usage
1. Name based hosting
    1. Deploy an OpenBSD virtual machine with one network-adapter in bridge mode
    2. Start a shell inside the vm and run `ifconfig`. The ipv4-address which can be found under em0 will be referred to as `<ipv4address>`
    3. Place `./Virtual-Web-Servers/Namebased/httpd.conf` at `/etc/httpd.conf` within the vm (requires su permissions)
    4. Run `mkdir -p /var/www/site1/www` within the vm (requires su permissions)
    5. Run `mkdir -p /var/www/site2/www` within the vm (requires su permissions)
    6. Run `rcctl enable httpd` within the vm (requires su permissions)
    7. Run `rcctl start httpd` within the vm (requires su permissions)
    8. Start a shell on your host machine and append the contents of `./Virtual-Web-Servers/Namebased/hosts` to `/etc/hosts` (requires su permissions)
    9. Open a browser on your host machine and type `web1.local` into the addressbar
    10. Open a browser on your host machine and type `web2.local` into the addressbar
2. IP based hosting
    1. Deploy an OpenBSD virtual machine with two network-adapters in bridge mode
    2. Start a shell inside the vm and run `ifconfig`. The ipv4-addresss which can be found under em0 and em1 will be referred to as `<ipv4address.em0>`and `<ipv4address.em1>`
    3. Place `./Virtual-Web-Servers/IPbased/httpd.conf` at `/etc/httpd.conf` within the vm (requires su permissions)
    4. Run `mkdir -p /var/www/site1/www` within the vm (requires su permissions)
    5. Run `mkdir -p /var/www/site2/www` within the vm (requires su permissions)
    6. Run `rcctl enable httpd` within the vm (requires su permissions)
    7. Run `rcctl start httpd` within the vm (requires su permissions)
    8. Start a shell on your host machine and append the contents of `./Virtual-Web-Servers/IPbased/hosts` to `/etc/hosts` (requires su permissions)
    9. Open a browser on your host machine and type `web1.local` into the addressbar
    10. Open a browser on your host machine and type `web2.local` into the addressbar
3. Port based hosting
    1. Deploy an OpenBSD virtual machine with one network-adapter in bridge mode
    2. Start a shell inside the vm and run `ifconfig`. The ipv4-address which can be found under em0 will be referred to as `<ipv4address>`
    3. Place `./Virtual-Web-Servers/Namebased/httpd.conf` at `/etc/httpd.conf` within the vm (requires su permissions)
    4. Run `mkdir -p /var/www/site1/www` within the vm (requires su permissions)
    5. Run `mkdir -p /var/www/site2/www` within the vm (requires su permissions)
    6. Run `rcctl enable httpd` within the vm (requires su permissions)
    7. Run `rcctl start httpd` within the vm (requires su permissions)
    8. Start a shell on your host machine and append the contents of `./Virtual-Web-Servers/Namebased/hosts` to `/etc/hosts` (requires su permissions)
    9. Open a browser on your host machine and type `web.local:80` into the addressbar
    10. Open a browser on your host machine and type `web.local:81` into the addressbar

**Note:**
1. For added convinience extract the ip-address of the virtual machine (e.g. with `ifconfig`-cmd). Then run `ssh username@ipAddress` on your host machine in order to start a remote shell.
2. You may want to delete anything you appended to `/etc/hosts`.

## Group Work 6
### Task
1. Implement a tiny webserver that supports name based virtual hosting and fulfills the following requirements
2. Implement a tiny proxy that prints all traffic (TODO: ,has a timeout) and fulfills the following requirements
- target system OpenBSD virtual machine
- written in Javascript and running in node.js

### Solution
`./node`
1. `./node/minimal-web-server.js`, `./node/hosts`
2. `./node/minimal-web-proxy.js`

### Usage
1. Tiny webserver
    1. Deploy an OpenBSD virtual machine with one network-adapter in bridge mode
    2. Start a shell inside the vm and run `ifconfig`. The ipv4-address which can be found under em0 will be referred to as `<ipv4address>`
    3. Place `./node/minimal-web-server.js` inside a `directory` of your choice within the vm
    4. Run `node minimal-web-server.js` inside the `directory` within the vm
    5. Start a shell on your host machine and append the contents of `./node/hosts` to `/etc/hosts` (requires su permissions)
    6. Run `curl http://web1.local:8080` on your host machine
    7. Run `curl http://web2.local:8080` on your host machine
    8. Run `curl http://<ipv4address>:8080` on your host machine
2. Tiny webproxy
    1. Deploy an OpenBSD virtual machine with one network-adapter in bridge mode
    2. Start a shell inside the vm and run `ifconfig`. The ipv4-address which can be found under em0 will be referred to as `<ipv4address>`
    3. Place `./node/minimal-web-proxy.js` inside a `directory` of your choice within the vm
    4. Run `node minimal-web-proxy.js` inside the `directory` within the vm
    5. Start a shell on your host machine and run `curl -x <ipv4address>:8080 example.com`
  
## Group Work 7
### Task
Provide a REST-API for the calculator developed in **Group Work 4**

### Solution
`./node/rest-api-server.js`

### Usage
1. Deploy an OpenBSD virtual machine with one network-adapter in bridge mode
2. Place `./node/rest-api-server.js` inside a `directory` of your choice within the vm
3. Start a shell inside the vm an run `node rest-api-server.js` inside the `directory` within the vm
4. 
