# gitbook-plugin-pageview-count-tp
使用php以及mysql进行访客统计
可在`book.json`->`"plugins"`中添加以使用该插件
```
{
    "plugins":[
       "pageview-count-tp@git+https://github.com/cyc1224/gitbook-plugin-pageview-count-tp.git#main"
    ]
}
```
在`book.json`->`"pluginsConfig"`中进行配置
```
{
    "plugins":[
       ...
    ]
    "pluginsConfig": {
        "pageview-count-tp": {
          "url": "https://example.com/abc"
        }
    }
}
```
然后执行`gitbook install`以安装该插件
