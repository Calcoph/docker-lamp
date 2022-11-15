with open("db_pass.txt", "r") as f:
    password = f.read()

with open("docker-compose.yml", "r") as f:
    lines = f.readlines()

new_text = []
for line in lines:
    if "MYSQL_PASSWORD" in line:
        line = line.split("MYSQL_PASSWORD")[0]
        line += f"MYSQL_PASSWORD: {password}\n"
    
    new_text.append(line)

with open("docker-compose.yml", "w") as f:
    f.writelines(new_text)
