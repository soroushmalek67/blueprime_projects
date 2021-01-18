<configuration>  
    <system.webserver>  
        <rewrite>  
            <rules>  
                <rule name="Index">  
                    <match url="^(.*)$">  
                    <conditions>  
                        <add input="{REQUEST_FILENAME}" matchtype="IsFile" negate="true">  
                        <add input="{REQUEST_FILENAME}" matchtype="IsDirectory" negate="true">  
                    </add></add></conditions>  
                    <action type="Rewrite" url="index.html/{R:1}">  
                </action></match></rule>  
            </rules>  
        </rewrite>  
    </system.webserver>  
</configuration> 