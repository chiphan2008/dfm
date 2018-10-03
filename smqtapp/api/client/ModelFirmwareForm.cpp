/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


#include "ModelFirmwareForm.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelFirmwareForm::ModelFirmwareForm(QString* json) {
    init();
    this->fromJson(*json);
}

ModelFirmwareForm::ModelFirmwareForm() {
    init();
}

ModelFirmwareForm::~ModelFirmwareForm() {
    this->cleanup();
}

void
ModelFirmwareForm::init() {
    id = 0L;
    device_model_id = 0L;
    server_ip = new QString("");
    username = new QString("");
    password = new QString("");
    path = new QString("");
    version = 0;
    filename = new QString("");
}

void
ModelFirmwareForm::cleanup() {


    if(server_ip != nullptr) {
        delete server_ip;
    }
    if(username != nullptr) {
        delete username;
    }
    if(password != nullptr) {
        delete password;
    }
    if(path != nullptr) {
        delete path;
    }

    if(filename != nullptr) {
        delete filename;
    }
}

ModelFirmwareForm*
ModelFirmwareForm::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelFirmwareForm::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&device_model_id, pJson["device_model_id"], "qint64", "");
    ::api::setValue(&server_ip, pJson["server_ip"], "QString", "QString");
    ::api::setValue(&username, pJson["username"], "QString", "QString");
    ::api::setValue(&password, pJson["password"], "QString", "QString");
    ::api::setValue(&path, pJson["path"], "QString", "QString");
    ::api::setValue(&version, pJson["version"], "qint32", "");
    ::api::setValue(&filename, pJson["filename"], "QString", "QString");
}

QString
ModelFirmwareForm::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelFirmwareForm::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("device_model_id", QJsonValue(device_model_id));
    toJsonValue(QString("server_ip"), server_ip, obj, QString("QString"));
    toJsonValue(QString("username"), username, obj, QString("QString"));
    toJsonValue(QString("password"), password, obj, QString("QString"));
    toJsonValue(QString("path"), path, obj, QString("QString"));
    obj->insert("version", QJsonValue(version));
    toJsonValue(QString("filename"), filename, obj, QString("QString"));

    return obj;
}

qint64
ModelFirmwareForm::getId() {
    return id;
}
void
ModelFirmwareForm::setId(qint64 id) {
    this->id = id;
}

qint64
ModelFirmwareForm::getDeviceModelId() {
    return device_model_id;
}
void
ModelFirmwareForm::setDeviceModelId(qint64 device_model_id) {
    this->device_model_id = device_model_id;
}

QString*
ModelFirmwareForm::getServerIp() {
    return server_ip;
}
void
ModelFirmwareForm::setServerIp(QString* server_ip) {
    this->server_ip = server_ip;
}

QString*
ModelFirmwareForm::getUsername() {
    return username;
}
void
ModelFirmwareForm::setUsername(QString* username) {
    this->username = username;
}

QString*
ModelFirmwareForm::getPassword() {
    return password;
}
void
ModelFirmwareForm::setPassword(QString* password) {
    this->password = password;
}

QString*
ModelFirmwareForm::getPath() {
    return path;
}
void
ModelFirmwareForm::setPath(QString* path) {
    this->path = path;
}

qint32
ModelFirmwareForm::getVersion() {
    return version;
}
void
ModelFirmwareForm::setVersion(qint32 version) {
    this->version = version;
}

QString*
ModelFirmwareForm::getFilename() {
    return filename;
}
void
ModelFirmwareForm::setFilename(QString* filename) {
    this->filename = filename;
}


}
