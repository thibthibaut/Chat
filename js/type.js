function type()
        {
            var str = text.substr(0, currentChar);
            var last = str.substr(str.length -1, str.length);
            if(last != '<' && last != '>' & last != '/') {
                $(".type").html(str);
            }
            currentChar++;
            if(currentChar <= text.length)
            {
                if(last == '<') {
                    htmltag = true;
                } else if(last == '>') {
                    htmltag = false;
                }
                if(htmltag) {
                    setTimeout(type, 1);
                } else {
                    setTimeout(type, 50);
                }
            }
        }