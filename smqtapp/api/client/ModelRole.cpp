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


#include "ModelRole.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelRole::ModelRole(QString* json) {
    init();
    this->fromJson(*json);
}

ModelRole::ModelRole() {
    init();
}

ModelRole::~ModelRole() {
    this->cleanup();
}

void
ModelRole::init() {
    id = 0L;
    name = new QString("");
    display_name = new QString("");
    created_at = NULL;
    updated_at = NULL;
}

void
ModelRole::cleanup() {

    if(name != nullptr) {
        delete name;
    }
    if(display_name != nullptr) {
        delete display_name;
    }
    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelRole*
ModelRole::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelRole::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&display_name, pJson["display_name"], "QString", "QString");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelRole::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelRole::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("display_name"), display_name, obj, QString("QString"));
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelRole::getId() {
    return id;
}
void
ModelRole::setId(qint64 id) {
    this->id = id;
}

QString*
ModelRole::getName() {
    return name;
}
void
ModelRole::setName(QString* name) {
    this->name = name;
}

QString*
ModelRole::getDisplayName() {
    return display_name;
}
void
ModelRole::setDisplayName(QString* display_name) {
    this->display_name = display_name;
}

QDateTime*
ModelRole::getCreatedAt() {
    return created_at;
}
void
ModelRole::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelRole::getUpdatedAt() {
    return updated_at;
}
void
ModelRole::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}

