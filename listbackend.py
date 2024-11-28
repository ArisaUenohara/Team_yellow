class_codes = []  # 作成されたクラスコードを保存

@app.route("/create_class_code", methods=["POST"])
def create_class_code():
    user = session.get("user")
    if not user or users[user]["role"] != "admin":
        return jsonify({"error": "管理者のみがクラスコードを作成できます"}), 403

    data = request.json
    class_code = data.get("class_code")
    if not class_code:
        return jsonify({"error": "クラスコードを入力してください"}), 400

    if class_code in class_codes:
        return jsonify({"error": "このクラスコードは既に存在します"}), 400

    class_codes.append(class_code)
    return jsonify({"message": f"クラスコード '{class_code}' を作成しました"}), 201
