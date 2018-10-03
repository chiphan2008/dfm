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


#include "ModelFirmware.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelFirmware::ModelFirmware(QString* json) {
    init();
    this->fromJson(*json);
}

ModelFirmware::ModelFirmware() {
    init();
}

ModelFirmware::~ModelFirmware() {
    this->cleanup();
}

void
ModelFirmware::init() {
    id = 0L;
    device_model_id = 0L;
    server_ip = new QString("");
    username = new QString("");
    password = new QString("");
    path = new QString("");
    version = 0;
    filename = new QString("");
    created_at = NULL;
    updated_at = NULL;
}

void
ModelFirmware::cleanup() {


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
    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelFirmware*
ModelFirmware::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelFirmware::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&device_model_id, pJson["device_model_id"], "qint64", "");
    ::api::setValue(&server_ip, pJson["server_ip"], "QString", "QString");
    ::api::setValue(&username, pJson["username"], "QString", "QString");
    ::api::setValue(&password, pJson["password"], "QString", "QString");
    ::api::setValue(&path, pJson["path"], "QString", "QString");
    ::api::setValue(&version, pJson["version"], "qint32", "");
    ::api::setValue(&filename, pJson["filename"], "QString", "QString");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelFirmware::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelFirmware::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    obj->insert("device_model_id", QJsonValue(device_model_id));
    toJsonValue(QString("server_ip"), server_ip, obj, QString("QString"));
    toJsonValue(QString("username"), username, obj, QString("QString"));
    toJsonValue(QString("password"), password, obj, QString("QString"));
    toJsonValue(QString("path"), path, obj, QString("QString"));
    obj->insert("version", QJsonValue(version));
    toJsonValue(QString("filename"), filename, obj, QString("QString"));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelFirmware::getId() {
    return id;
}
void
ModelFirmware::setId(qint64 id) {
    this->id = id;
}

qint64
ModelFirmware::getDeviceModelId() {
    return device_model_id;
}
void
ModelFirmware::setDeviceModelId(qint64 device_model_id) {
    this->device_model_id = device_model_id;
}

QString*
ModelFirmware::getServerIp() {
    return server_ip;
}
void
ModelFirmware::setServerIp(QString* server_ip) {
    this->server_ip = server_ip;
}

QString*
ModelFirmware::getUsername() {
    return username;
}
void
ModelFirmware::setUsername(QString* username) {
    this->username = username;
}

QString*
ModelFirmware::getPassword() {
    return password;
}
void
ModelFirmware::setPassword(QString* password) {
    this->password = password;
}

QString*
ModelFirmware::getPath() {
    return path;
}
void
ModelFirmware::setPath(QString* path) {
    this->path = path;
}

qint32
ModelFirmware::getVersion() {
    return version;
}
void
ModelFirmware::setVersion(qint32 version) {
    this->version = version;
}

QString*
ModelFirmware::getFilename() {
    return filename;
}
void
ModelFirmware::setFilename(QString* filename) {
    this->filename = filename;
}

QDateTime*
ModelFirmware::getCreatedAt() {
    return created_at;
}
void
ModelFirmware::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelFirmware::getUpdatedAt() {
    return updated_at;
}
void
ModelFirmware::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}
