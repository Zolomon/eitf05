# Cryptography
## Note: The purpose of the first part is to review the necessary requirements for the course. Learn enough of the topics from this chapter to be able to understand the remaining contents of the course. Exam question may assume that you know the underlying cryptography. Explicit cryptography questions may also appear on the exam, but not in abundance. Only the high profile topics are listed here.
[ ] How does the birthday paradox apply to finding collisions?

//If a hash function has less distributions than the possible items to hash, there will be a collision

If a hash function's range is N, and there are > N items to hash, then there will be a collision according to the pigeonhole theorem which is used to prove the birthday paradox.


[ ] How TMTO and rainbow tables work.
[ ] How digital signatures work in general, and for RSA.
[ ] The purpose of digital certificates.

# HTTP Security, Apache Security
[ ] The basic principles of HTTP communication.
[ ] HTTP methods GET, HEAD and POST. Safe and Idempotent methods.
[ ] Similarities and differences regarding POST and GET.
[ ] What cookies are and how and when they are sent/received.
[ ] First- vs. third party cookies. User tracking with both kinds.
[ ] Review the cookie attack terminology.
[ ] The relationship between httpd.conf and .htaccess-files.
[ ] You should be able to encode to and decode from Base64 encoding. You do not need to remember the Base64 alphabet or ASCII codes for letters and numbers.
[ ] Why is Base64 used at all, since it is just a way of expanding text?
[ ] How Basic Authentication works.
[ ] How Digest Authentication (RFC2069, 1997) works. The digest formula will be given if you need it.
[ ] How Digest Authentication (RFC2617, 1999) works. The digest formula will be given if you need it.
[ ] What problems with RFC2069 were discovered and fixed? Which problems remain?

# Web applications and PHP security
## Note: You will not be asked write PHP code on the exam. You may, however, be asked to interpret given PHP code.
[ ] What is the purpose of the same-origin policy, and how does it work?
[ ] Explain the ways in which the same-origin policy can be bypassed; proxy, iFrames, JSONP and DNS rebinding.
[ ] How CORS works.
[ ] The principles of PHP.
[ ] Usage of php.ini, securing operation and limiting information.
[ ] Be able to discuss pros and cons of register globals.
[ ] Be able to illustrate how failure to validate input may lead to execution of code or JavaScript.
[ ] How remote file inclusion works.
[ ] Be able to read given and construct your own simple regular expressions.
[ ] Compare the two ways of handling sessions in PHP.
[ ] Explain how a session fixation attack works, what its requirements and limitations are, and how to prevent it.
[ ] What is session hijacking?
[ ] Explain how session prediction works, what its requirements and limitations are, and how to prevent it.
[ ] Explain how session sniffing works, what its requirements and limitations are, and how to prevent it.
[ ] Explain how an XSS attack works, what its requirements and limitations are, and how to prevent it.
[ ] How does CSP work?
[ ] Explain how a CSRF attack works, what its requirements and limitations are, and how to prevent it.
[ ] Explain how a CRLF attack and HTTP response splitting work.
[ ] Explain how an SQL injection attack works, what its requirements and limitations are, and show a few ways of preventing such attacks.

# DNS
[ ] The principles of DNS.
[ ] How DNS amplification works.
[ ] The principles of DNS cache poisoning and how this attack can be made more efficient.
[ ] Explain how a DNS cache attack can realize a man-in-the-middle attack.
[ ] Explain how a DNS rebinding attack works.
[ ] What is DNS pinning and DNS anti-pinning?
[ ] Explain the principles of DNSSEC. Which services are provided and at what cost?
[ ] Explain the usage of DNSKEY, RRSIG, NSEC and DS records in DNSSEC.
[ ] When are DNSSEC signatures calculated (and re-calculated)?
[ ] How are signatures and keys verified? Compare key verification functionality to the corresponding usage of digital certificates.
[ ] How NSEC and zone enumeration works. How is the zone enumeration problem avoided in NSEC3?
[ ] Name one attack type that is prevented by DNSSEC, and name one that becomes more efficient.

# Email security
[ ] The principles of SMTP.
[ ] Be able to read and interpret common mail headers in general and the Received header in particular. Distinguishing forged emails from genuine ones.
[ ] Usage of MX-records.
[ ] DKIM functionality. Explain how the signature is created and verified, and explain how and to what extent integrity protection is provided.
[ ] Explain how a DNSBL can be used to fight spam. Pros and cons?
[ ] Explain how a URI DNSBL works.
[ ] Explain how Greylisting can be used to fight spam. Pros and cons?
[ ] Explain how Nolisting can be used to fight spam. Pros and cons?
[ ] Usage of SPF-records and their relation to MX-records.
[ ] How DMARC works.
[ ] The principles of Hashcash.
[ ] In a sentence or two, describe how hybrid filters work.

# Very few of the following topics will show up on the exam. These should be studied after you know everything above. The list is sorted but not divided into chapters. Consider these as less important:
[ ] Hash function properties: Pre-image resistance, 2nd pre-image resistance, collision resistance.
[ ] What are hash functions used for?
[ ] Stream cipher functionality. Compare to the One-Time-Pad.
[ ] Block ciphers and their modes of operation.
[ ] Two simple but bad MAC constructions.
[ ] How does HMAC work?
[ ] How does CBC-MAC work? How can you find collisions for a one-block message (m; t)?
[ ] You should be able to perform RSA calculations with artificially small numbers.
[ ] URL encoding.
[ ] How to use httpd.conf to limit access to directories.
[ ] How to use httpd.conf to limit information to adversaries.
[ ] Explain how statistical filtering can be used to fight spam. Pros and cons? Given Bayes law, derive the formulas for the log-likelihood ratio and interpret the threshold value 0 (zero).

# The following topics will NOT be covered by the exam, but if you are interested in the topic and have lots of time left you can look at it. The list is sorted but not divided into chapters. Consider these as least important.
[ ] The One-Time-Pad.
[ ] The iterative Merkle-Damgaard contruction.